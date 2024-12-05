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
        $sql = "SELECT department_name, id FROM dept_dean";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Normalize department names to lowercase for case-insensitive matching
                $department_map[strtolower(trim($row['department_name']))] = $row['id'];
            }
        }
        error_log('Department Map: ' . print_r($department_map, true));
    
        foreach ($sheetData as $row) {
            // Skip the header row and any empty rows
            if ($row['A'] == 'last_name' || (empty(array_filter($row, fn($value) => !is_null($value) && trim($value) !== '')))) {
                continue;
            }
    
            // Extract and clean data
            $last_name = isset($row['A']) ? trim($row['A']) : null;
            $first_name = isset($row['B']) ? trim($row['B']) : null;
            $gender = isset($row['C']) ? trim($row['C']) : null;
            $studentID = isset($row['D']) ? trim($row['D']) : null;
            $department_name = isset($row['E']) ? strtolower(trim($row['E'])) : null; // Normalize case
            $department_id = isset($department_map[$department_name]) ? $department_map[$department_name] : null;
            $username = isset($row['F']) ? trim($row['F']) : null;
            $password = isset($row['G']) ? password_hash(trim($row['G']), PASSWORD_BCRYPT) : null;
    
            // Debugging logs
            error_log('Processing Row: ' . print_r($row, true));
            error_log('Processing Department: ' . $department_name . ', Mapped ID: ' . $department_id);
    
            if (!$department_id) {
                error_log('Invalid Department: ' . $department_name . '. Skipping row.');
                continue;
            }
    
            if ($last_name && $first_name && $gender && $studentID && $username && $password) {
                try {
                    $conn->begin_transaction();
    
                    // Insert into users table with department_id
                    $sql = "INSERT INTO users (last_name, first_name, gender, department_id, username, password, user_type) 
                            VALUES (?, ?, ?, ?, ?, ?, 'intern')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $last_name, $first_name, $gender, $department_id, $username, $password); // Correct parameter binding
    
                    if ($stmt->execute()) {
                        $user_id = $conn->insert_id;
                        error_log('Inserted user with ID: ' . $user_id);  // Log user ID to verify insertion
    
                        // Insert into student table
                        $sql_intern = "INSERT INTO student (studentID, user_id) VALUES (?, ?)";
                        $stmt_intern = $conn->prepare($sql_intern);
                        $stmt_intern->bind_param("si", $studentID, $user_id);
                        $stmt_intern->execute();
                    } else {
                        error_log('Error executing insert into users: ' . $stmt->error);
                        echo json_encode(['error' => 'Failed to insert user']);
                        exit;
                    }
    
                    $conn->commit();
                } catch (Exception $e) {
                    $conn->rollback();
                    error_log('Error inserting row: ' . $e->getMessage());
                    continue;
                }
            } else {
                error_log('Missing required fields for row: ' . print_r($row, true));
            }
        }
    
        echo json_encode(['success' => 'Data successfully inserted into the database']);
    }
?>