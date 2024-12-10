<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    
    include('../../../dbconn.php'); // Database connection

    // Ensure required fields are set
    if (isset($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['password'], $_POST['department1'])) {
        // Gather POST data
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT); // Hash the password
        $department1 = $_POST['department1'];
        $department2 = isset($_POST['department2']) ? $_POST['department2'] : null;
        $department3 = isset($_POST['department3']) ? $_POST['department3'] : null;

        // Insert into users table (dean)
        $sql = "INSERT INTO users (last_name, first_name, username, password, user_type) 
                VALUES ('$last_name', '$first_name', '$username', '$password', 'Dean')";

        if ($conn->query($sql) === TRUE) {
            $dean_id = $conn->insert_id; // Get the newly inserted dean's user_id

            // Insert into dean_department table for each department selected
            $departments = [$department1, $department2, $department3];
            foreach ($departments as $department_id) {
                if ($department_id) {
                    $insertDeptSql = "INSERT INTO dean_department (dean_id, department_id) VALUES ('$dean_id', '$department_id')";
                    if (!$conn->query($insertDeptSql)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to assign department: ' . $conn->error]);
                        exit();
                    }
                }
            }

            // Success response
            echo json_encode(['success' => true]);

        } else {
            // Failure response
            echo json_encode(['success' => false, 'error' => 'Error inserting dean into users']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    }

    $conn->close();
?>