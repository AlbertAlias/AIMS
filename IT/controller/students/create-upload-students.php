<?php
require '../../../dbconn.php';

// Ensure JSON response with no stray output
header('Content-Type: application/json');
ob_start(); // Start output buffering
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(0);

$response = [];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];

        if ($file['error'] != UPLOAD_ERR_OK) {
            $response['error'] = 'Error uploading file.';
            ob_clean(); // Clear any output
            echo json_encode($response);
            exit();
        }

        $filePath = $file['tmp_name'];
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Skip header row
            fgetcsv($handle);

            $usersInsertQuery = "INSERT INTO users (last_name, first_name, gender, username, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, 'student', ?)";
            $studentsInsertQuery = "INSERT INTO students (user_id, studentID) VALUES (?, ?)";

            $usersStmt = $conn->prepare($usersInsertQuery);
            $studentsStmt = $conn->prepare($studentsInsertQuery);

            while (($data = fgetcsv($handle)) !== false) {
                $lastName = $data[0];
                $firstName = $data[1];
                $gender = $data[2];
                $studentID = $data[3];
                $departmentName = $data[4];
                $username = $data[5];
                $password = password_hash($data[6], PASSWORD_BCRYPT);

                // Get department_id
                $deptQuery = "SELECT id FROM department_dean WHERE department_name = ?";
                $deptStmt = $conn->prepare($deptQuery);
                $deptStmt->bind_param('s', $departmentName);
                $deptStmt->execute();
                $deptStmt->bind_result($department_id);
                if (!$deptStmt->fetch()) {
                    $response['error'] = "Department not found: $departmentName";
                    $deptStmt->close();
                    ob_clean(); // Clear any output
                    echo json_encode($response);
                    exit();
                }
                $deptStmt->close();

                $usersStmt->bind_param('sssssi', $lastName, $firstName, $gender, $username, $password, $department_id);
                if ($usersStmt->execute()) {
                    $userId = $usersStmt->insert_id;
                    $studentsStmt->bind_param('is', $userId, $studentID);
                    $studentsStmt->execute();
                } else {
                    $response['error'] = 'Error inserting data into users table.';
                    ob_clean(); // Clear any output
                    echo json_encode($response);
                    exit();
                }
            }

            fclose($handle);
            $response['success'] = 'File uploaded successfully';
            ob_clean(); // Clear any output
            echo json_encode($response);
        } else {
            $response['error'] = 'Unable to open the file.';
            ob_clean(); // Clear any output
            echo json_encode($response);
        }
    } else {
        $response['error'] = 'No file uploaded.';
        ob_clean(); // Clear any output
        echo json_encode($response);
    }
} catch (Exception $e) {
    $response['error'] = 'An unexpected error occurred: ' . $e->getMessage();
    ob_clean(); // Clear any output
    echo json_encode($response);
}

ob_end_flush(); // End output buffering and flush the output
?>