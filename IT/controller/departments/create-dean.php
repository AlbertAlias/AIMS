<?php
    require_once '../../../dbconn.php';

    // Check if the required fields are set
    if (isset($_POST['last_name'], $_POST['first_name'], $_POST['dean_department'], $_POST['username'], $_POST['password'])) {
        // Sanitize input to prevent SQL injection
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $dean_department = (int)$_POST['dean_department']; // Department ID (numeric)
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

        // Check if the department exists
        $checkDeptQuery = "SELECT id FROM departments WHERE id = $dean_department";
        $deptResult = $conn->query($checkDeptQuery);

        if ($deptResult->num_rows > 0) {
            // Insert into users table for the dean
            $insertUserQuery = "INSERT INTO users (last_name, first_name, username, password, user_type, department_id) 
                                VALUES ('$last_name', '$first_name', '$username', '$password', 'dean', $dean_department)";
            if ($conn->query($insertUserQuery) === TRUE) {
                // Get the newly created user's ID
                $userId = $conn->insert_id;

                // Insert into dean table to assign the user as dean
                $insertDeanQuery = "INSERT INTO dean (user_id) VALUES ($userId)";
                if ($conn->query($insertDeanQuery) === TRUE) {
                    // Get the newly created dean's ID
                    $deanId = $conn->insert_id;

                    // Update the department's dean_id field to the dean's ID
                    $updateDeptQuery = "UPDATE departments SET dean_id = $deanId WHERE id = $dean_department";
                    if ($conn->query($updateDeptQuery) === TRUE) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['error' => 'Failed to update department with dean_id']);
                    }
                } else {
                    echo json_encode(['error' => 'Failed to assign user as dean']);
                }
            } else {
                echo json_encode(['error' => 'Failed to create user']);
            }
        } else {
            echo json_encode(['error' => 'Invalid department']);
        }
    } else {
        echo json_encode(['error' => 'Missing required fields']);
    }

    $conn->close();
?>