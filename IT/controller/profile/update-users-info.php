<?php
    session_start();
    include('../../../dbconn.php');

    $user_id = $_SESSION['user_id'] ?? null;

    // Check if password change is requested
    if (isset($_POST['old_password'], $_POST['new_password'])) {
        if ($user_id) {
            $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            
            // Retrieve the current password from the database
            $sql = "SELECT password FROM users WHERE user_id = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['password'];

                // Verify the old password
                if (password_verify($old_password, $hashed_password)) {
                    // Hash the new password and update it
                    $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $update_sql = "UPDATE users SET password = '$new_hashed_password' WHERE user_id = $user_id";
                    
                    if ($conn->query($update_sql) === TRUE) {
                        echo json_encode(['success' => true, 'message' => 'Password changed successfully.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error updating password.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Old password is incorrect.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'User not found.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User ID not provided.']);
        }
        exit;
    }

    // Existing logic for updating user info
    if ($user_id && isset($_POST['last_name'], $_POST['first_name'])) {
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $middle_name = isset($_POST['middle_name']) && $_POST['middle_name'] != '' ? mysqli_real_escape_string($conn, $_POST['middle_name']) : null;
        $gender = isset($_POST['gender']) && $_POST['gender'] != '' ? mysqli_real_escape_string($conn, $_POST['gender']) : null;
        $address = isset($_POST['address']) && $_POST['address'] != '' ? mysqli_real_escape_string($conn, $_POST['address']) : null;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
        $username = isset($_POST['username']) && $_POST['username'] != '' ? mysqli_real_escape_string($conn, $_POST['username']) : null;

        $sql = "UPDATE users SET
                last_name = '$last_name',
                first_name = '$first_name',
                middle_name = '$middle_name',
                gender = '$gender',
                address = '$address',
                email = '$email',
                username = '$username'
                WHERE user_id = $user_id";

        if ($conn->query($sql) === TRUE) {
            // Update session variable with the new username
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true]);
        } else {
            error_log("Database update failed: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Database update failed: ' . $conn->error]);
        }
    } else {
        error_log('User ID or required data not provided: ' . print_r($_POST, true));
        echo json_encode(['success' => false, 'message' => 'User ID or required data not provided.']);
    }
?>