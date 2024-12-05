<?php
require '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors during file upload
    if ($file['error'] != UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'Error uploading file.']);
        exit();
    }

    // Get file details
    $filePath = $file['tmp_name'];
    if (($handle = fopen($filePath, 'r')) !== false) {
        // Skip header row
        fgetcsv($handle);

        // Prepare SQL statements for inserting data
        $usersInsertQuery = "INSERT INTO users (last_name, first_name, gender, username, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, 'student', ?)";
        $studentsInsertQuery = "INSERT INTO students (user_id, studentID) VALUES (?, ?)";

        // Prepare statements
        $usersStmt = $conn->prepare($usersInsertQuery);
        $studentsStmt = $conn->prepare($studentsInsertQuery);

        // Loop through CSV rows
        while (($data = fgetcsv($handle)) !== false) {
            $lastName = $data[0];
            $firstName = $data[1];
            $gender = $data[2];
            $studentID = $data[3];
            $departmentName = $data[4];
            $username = $data[5];
            $password = password_hash($data[6], PASSWORD_BCRYPT); // Hash password

            // Get department_id from department_dean table
            $deptQuery = "SELECT id FROM department_dean WHERE department_name = ?";
            $deptStmt = $conn->prepare($deptQuery);
            $deptStmt->bind_param('s', $departmentName);
            $deptStmt->execute();
            $deptStmt->bind_result($department_id);
            $deptStmt->fetch();
            $deptStmt->close();

            // Insert into users table
            $usersStmt->bind_param('sssssi', $lastName, $firstName, $gender, $username, $password, $department_id);
            if ($usersStmt->execute()) {
                $userId = $usersStmt->insert_id;

                // Insert into students table
                $studentsStmt->bind_param('is', $userId, $studentID);
                $studentsStmt->execute();
            } else {
                echo json_encode(['error' => 'Error inserting data into users table.']);
                exit();
            }
        }

        fclose($handle);
        echo json_encode(['success' => 'File uploaded successfully']);
    } else {
        echo json_encode(['error' => 'Unable to open the file.']);
    }
} else {
    echo json_encode(['error' => 'No file uploaded.']);
}
?>
