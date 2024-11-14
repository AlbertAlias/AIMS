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

        // Department mapping
        $department_map = [
            'Accountancy' => 1,
            'Business Administration' => 2,
            'Computer Engineering' => 3,
            'Criminology' => 4,
            'Computer Science' => 5,
            'Education' => 6,
            'Hospitality Management' => 7,
            'Information Technology' => 8,
            'Tourism Management' => 9,
        ];

        foreach ($sheetData as $row) {
            // Skip the header row and any completely empty rows
            if ($row['A'] == 'last_name' || (empty(array_filter($row, fn($value) => !is_null($value) && trim($value) !== '')))) {
                continue;
            }

            // Data extraction with null checks and trimming of whitespace
            $last_name = isset($row['A']) && trim($row['A']) !== '' ? $conn->real_escape_string(trim($row['A'])) : null;
            $first_name = isset($row['B']) && trim($row['B']) !== '' ? $conn->real_escape_string(trim($row['B'])) : null;
            $gender = isset($row['E']) && trim($row['E']) !== '' ? $conn->real_escape_string(trim($row['E'])) : null;
            $studentID = isset($row['K']) && trim($row['K']) !== '' ? $conn->real_escape_string(trim($row['K'])) : null;
            $department_name = isset($row['L']) && trim($row['L']) !== '' ? trim($row['L']) : null;
            $department_id = $department_map[$department_name] ?? null;
            $username = isset($row['M']) && trim($row['M']) !== '' ? $conn->real_escape_string(trim($row['M'])) : null;
            $password = isset($row['N']) && trim($row['N']) !== '' ? password_hash(trim($row['N']), PASSWORD_BCRYPT) : null;
            $user_type = 'intern';
        
            // Check if required fields are present
            if ($last_name && $first_name && $username && $password) {
                // Fetch coordinator's initials
                $coor_sql = "SELECT last_name, first_name FROM coordinators WHERE department_id = $department_id LIMIT 1";
                $coor_result = $conn->query($coor_sql);
                if ($coor_result->num_rows > 0) {
                    $coor_row = $coor_result->fetch_assoc();
                    $coor_last_name = $coor_row['last_name'];
                    $coor_first_name = $coor_row['first_name'];

                    // Generate intern_id using the coordinator's initials
                    $intern_id = strtoupper(substr($coor_last_name, 0, 1) . substr($coor_first_name, 0, 1) . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT));

                    // Insert into users table
                    $sql = "INSERT INTO users (last_name, first_name, gender, department_id, username, password, user_type) 
                            VALUES ('$last_name', '$first_name', '$gender', '$department_id', '$username', '$password', '$user_type')";
            
                    if ($conn->query($sql) === TRUE) {
                        $user_id = $conn->insert_id;

                        // Insert into interns table with intern_id
                        $sql_interns = "INSERT INTO interns (user_id, studentID, intern_id) VALUES ($user_id, '$studentID', '$intern_id')";
                        if ($conn->query($sql_interns) !== TRUE) {
                            echo json_encode(['error' => 'Error inserting into interns table: ' . $conn->error]);
                            exit;
                        }

                        // Insert intern_id into coordinators table
                        $intern_id = strtoupper(substr($coor_last_name, 0, 1) . substr($coor_first_name, 0, 1));

                        $sql_coor = "UPDATE coordinators SET intern_id = '$intern_id' WHERE department_id = $department_id";
                        if ($conn->query($sql_coor) !== TRUE) {
                            echo json_encode(['error' => 'Error updating coordinators table: ' . $conn->error]);
                            exit;
                        }
                    } else {
                        echo json_encode(['error' => 'Error inserting into users table: ' . $conn->error]);
                        exit;
                    }
                } else {
                    echo json_encode(['error' => 'Coordinator not found for department: ' . $department_name]);
                    exit;
                }
            } else {
                // Log the problematic row for debugging
                echo json_encode([
                    'error' => 'Missing required fields for row',
                    'row' => $row
                ]);
                exit;
            }
        }

        echo json_encode(['success' => 'Data successfully inserted into the database']);
    }
?>