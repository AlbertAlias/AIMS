<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../../dbconn.php';

    // Autoload function for PhpSpreadsheet classes
    spl_autoload_register(function ($class) {
        $prefix = 'PhpOffice\\PhpSpreadsheet\\';
        $base_dir = __DIR__ . '/../../../../libraries/PhpSpreadsheet-3.3.0/src/PhpSpreadsheet/';

        // Check if class uses the namespace prefix for PhpSpreadsheet
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }

        // Now check for Psr\SimpleCache classes
        $psr_prefix = 'Psr\\SimpleCache\\';
        $psr_base_dir = __DIR__ . '/../../../../libraries/Psr/simple-cache-master/src/';
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

    // Use the necessary namespaces
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Check for file upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'File upload error']);
            exit;
        }

        // Load the spreadsheet
        try {
            $spreadsheet = IOFactory::load($file['tmp_name']);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to load spreadsheet: ' . $e->getMessage()]);
            exit;
        }

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Prepare SQL insert statement for users
        $user_stmt = $conn->prepare(
            "INSERT INTO users (last_name, first_name, middle_name, suffix, gender, address, birthdate, 
                                    civil_status, personal_email, contact_number, account_email, password, user_type, 
                                    department_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Loop through each row of data
        foreach ($sheetData as $row) {
            // Skip the header row if it exists
            if ($row['A'] === 'last_name') continue;

            // Get and validate the password
            $password = isset($row['N']) ? $row['N'] : ''; // Get the password
            if (empty($password)) {
                echo json_encode(['error' => 'Password cannot be empty for user: ' . $row['A'] . ' ' . $row['B']]);
                exit;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data
            $user_stmt->bind_param('sssssssssssssi', 
                $row['A'], // last_name
                $row['B'], // first_name
                $row['C'], // middle_name
                $row['D'], // suffix
                $row['E'], // gender
                $row['F'], // address
                $row['G'], // birthdate
                $row['H'], // civil_status
                $row['I'], // personal_email
                $row['J'], // contact_number
                $row['M'], // account_email
                $hashedPassword, // password
                $row['L'], // user_type
                $row['K']  // department_id
            );

            // Execute the user insert statement and handle errors
            if (!$user_stmt->execute()) {
                echo json_encode(['error' => 'Failed to execute statement for user: ' . $row['A'] . ' ' . $row['B'] . '. Error: ' . $user_stmt->error]);
                exit;
            }

            // Get the last inserted user ID
            $user_id = $conn->insert_id;

            // Now prepare to insert into the interns table
            $intern_stmt = $conn->prepare("INSERT INTO interns (user_id, studentID) VALUES (?, ?)");
            $studentID = isset($row['K']) ? $row['K'] : ''; // Assuming studentID is in the column corresponding to 'K'

            // Bind parameters for interns table
            $intern_stmt->bind_param('is', $user_id, $studentID); // user_id and studentID

            // Execute the interns insert statement and handle errors
            if (!$intern_stmt->execute()) {
                echo json_encode(['error' => 'Failed to execute statement for intern: ' . $row['A'] . ' ' . $row['B'] . '. Error: ' . $intern_stmt->error]);
                exit;
            }

            // Close the intern statement
            $intern_stmt->close();
        }

        $user_stmt->close();
        echo json_encode(['success' => 'Data uploaded successfully']);
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }
?>