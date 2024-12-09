<?php
    include('../../../dbconn.php'); // Database connection

    // Retrieve form data
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $department1 = $_POST['department1'];
    $department2 = $_POST['department2'];
    $department3 = $_POST['department3'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Step 1: Insert the user (Dean) into the users table
    $sql = "INSERT INTO users (last_name, first_name, user_type, username, password) VALUES (?, ?, 'Dean', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $last_name, $first_name, $username, $hashed_password);

    if ($stmt->execute()) {
        $dean_id = $stmt->insert_id; // Get the ID of the newly inserted dean

        // Step 2: Update departments with the new dean_id
        $departments = [$department1, $department2, $department3];
        foreach ($departments as $department_id) {
            if (!empty($department_id)) {
                $update_sql = "UPDATE department SET dean_id = ? WHERE department_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("ii", $dean_id, $department_id);
                $update_stmt->execute();
            }
        }

        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return error response
        echo json_encode(['success' => false, 'message' => 'Failed to assign dean']);
    }

    $stmt->close();
    $conn->close();
?>