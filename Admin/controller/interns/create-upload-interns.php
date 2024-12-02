<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../dbconn.php';

    spl_autoload_register(function ($class) {
        $prefix = 'PhpOffice\\PhpSpreadsheet\\';
        $base_dir = __DIR__ . '/../../../libraries/PhpSpreadsheet-3.3.0/src/PhpSpreadsheet/';
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }

        $psr_prefix = 'Psr\\SimpleCache\\';
        $psr_base_dir = __DIR__ . '/../../../libraries/Psr/simple-cache-master/src/';
        $psr_len = strlen($psr_prefix);
        if (strncmp($psr_prefix, $class, $psr_len) === 0) {
            $relative_class = substr($class, $psr_len);
            $file = $psr_base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    });

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'File upload error']);
            exit;
        }

        try {
            $spreadsheet = IOFactory::load($file['tmp_name']);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to load spreadsheet: ' . $e->getMessage()]);
            exit;
        }

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Dynamically fetch the department map from the database
        $department_map = [];
        $sql = "SELECT department_name, id FROM departments";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $department_map[$row['department_name']] = $row['id'];
            }
        }

        foreach ($sheetData as $row) {
            // Skip the header row and any empty rows
            if ($row['A'] == 'intern_id' || (empty(array_filter($row, fn($value) => !is_null($value) && trim($value) !== '')))) {
                continue;
            }

            // Extract and clean data
            $intern_id = isset($row['A']) ? trim($row['A']) : null;
            $last_name = isset($row['B']) ? trim($row['B']) : null;
            $first_name = isset($row['C']) ? trim($row['C']) : null;
            $gender = isset($row['D']) ? trim($row['D']) : null;
            $studentID = isset($row['E']) ? trim($row['E']) : null;
            $department_name = isset($row['F']) ? trim($row['F']) : null;
            $department_id = isset($department_map[$department_name]) ? $department_map[$department_name] : null;
            $username = isset($row['G']) ? trim($row['G']) : null;
            $password = isset($row['H']) ? password_hash(trim($row['H']), PASSWORD_BCRYPT) : null;
            $user_type = 'intern';

            // Log the row for debugging
            error_log('Processing row: ' . print_r($row, true));

            // Ensure required fields are not empty
            if ($intern_id && $last_name && $first_name && $gender && $studentID && $department_id && $username && $password) {
                $conn->begin_transaction();

                try {
                    // Check if the intern_id already exists in the interns table for the same department
                    $check_sql = "SELECT COUNT(*) FROM interns i
                                JOIN users u ON i.user_id = u.id
                                WHERE i.intern_id = ? AND u.department_id = ?";
                    $stmt = $conn->prepare($check_sql);
                    $stmt->bind_param("si", $intern_id, $department_id);  // Check if intern_id exists with the same department_id
                    $stmt->execute();
                    $stmt->bind_result($count);
                    $stmt->fetch();
                    $stmt->free_result();  // Free the result set to avoid 'Commands out of sync' error

                    if ($count > 0) {
                        // If intern_id already exists in the same department, skip this row
                        echo json_encode(['error' => 'Intern ID ' . $intern_id . ' already exists in this department']);
                        exit;
                    }

                    // Get coordinator's details
                    $coor_sql = "
                        SELECT u.last_name, u.first_name 
                        FROM coordinators c
                        JOIN users u ON c.user_id = u.id
                        WHERE c.department_id = ? LIMIT 1";
                    
                    $stmt = $conn->prepare($coor_sql);
                    $stmt->bind_param("i", $department_id); // Bind department_id as integer
                    $stmt->execute();
                    $coor_result = $stmt->get_result();
                    
                    // Ensure the previous query is fully processed before proceeding
                    $stmt->free_result();  // Free result to ensure no 'Commands out of sync' error

                    if ($coor_result->num_rows > 0) {
                        $coor_row = $coor_result->fetch_assoc();
                        $coor_last_name = $coor_row['last_name'];
                        $coor_first_name = $coor_row['first_name'];

                        // Insert intern data into users table
                        $sql = "INSERT INTO users (last_name, first_name, gender, department_id, username, password, user_type) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssssss", $last_name, $first_name, $gender, $department_id, $username, $password, $user_type);
                        if ($stmt->execute()) {
                            // Get the last inserted user ID
                            $user_id = $conn->insert_id;

                            // Insert intern data into interns table with provided intern_id
                            $sql_intern = "INSERT INTO interns (intern_id, studentID, user_id) 
                                        VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql_intern);
                            $stmt->bind_param("ssi", $intern_id, $studentID, $user_id);
                            $stmt->execute();
                        }
                    }

                    // Commit transaction
                    $conn->commit();
                } catch (Exception $e) {
                    // Rollback if any error occurs
                    $conn->rollback();
                    echo json_encode(['error' => 'Failed to insert data: ' . $e->getMessage()]);
                    exit;
                }
            } else {
                // Log missing fields for the row
                error_log('Missing required fields for row: ' . print_r($row, true));
                echo json_encode(['error' => 'Missing required fields for row', 'row' => $row]);
                exit;
            }
        }

        echo json_encode(['success' => 'Data successfully inserted into the database']);
    }
?>