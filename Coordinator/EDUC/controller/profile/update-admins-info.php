<?php
    session_start();
    include('../../../../aims_db.sql');

    $user_id = $_SESSION['user_id'] ?? null;

    // Check if password change is requested
    if (isset($_POST['old_password'], $_POST['new_password'])) {
        if ($user_id) {
            $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            
            // Retrieve the current password from the database
            $sql = "SELECT password FROM users WHERE id = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['password'];

                // Verify the old password
                if (password_verify($old_password, $hashed_password)) {
                    // Hash the new password and update it
                    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_sql = "UPDATE users SET password = '$new_hashed_password' WHERE id = $user_id";
                    
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
        $suffix = isset($_POST['suffix']) && $_POST['suffix'] != '' ? mysqli_real_escape_string($conn, $_POST['suffix']) : null;
        $address = isset($_POST['address']) && $_POST['address'] != '' ? mysqli_real_escape_string($conn, $_POST['address']) : null;
        $civil_status = isset($_POST['civil_status']) && $_POST['civil_status'] != '' ? mysqli_real_escape_string($conn, $_POST['civil_status']) : null;
        $personal_email = isset($_POST['personal_email']) ? mysqli_real_escape_string($conn, $_POST['personal_email']) : '';
        $username = isset($_POST['username']) && $_POST['username'] != '' ? mysqli_real_escape_string($conn, $_POST['username']) : null;

        $sql = "UPDATE users SET
                last_name = '$last_name',
                first_name = '$first_name',
                middle_name = '$middle_name',
                suffix = '$suffix',
                address = '$address',
                civil_status = '$civil_status',
                personal_email = '$personal_email',
                username = '$username'
                WHERE id = $user_id";

        if ($conn->query($sql) === TRUE) {
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