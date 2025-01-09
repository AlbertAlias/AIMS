<?php
    session_start();
    require '../../../dbconn.php';

    if (!isset($_SESSION['username'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in or session expired']);
        exit();
    }

    $user_username = $_SESSION['username'];

    if (isset($_POST['oldPassword'])) {
        $old_password = $_POST['oldPassword'];

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param('s', $user_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            if (password_verify($old_password, $hashed_password)) {
                echo json_encode(['status' => 'success', 'message' => 'Password match']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Password does not match']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        exit();
    }

    $stmt = $conn->prepare("SELECT last_name, first_name, middle_name, address, gender, email, username 
                                FROM users 
                                WHERE username = ?");
    $stmt->bind_param('s', $user_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($last_name, $first_name, $middle_name, $address, $gender, $email, $username);
        $stmt->fetch();

        $full_name = $last_name . ', ' . $first_name;
        if ($middle_name) $full_name .= ' ' . $middle_name;

        echo json_encode([
            'status' => 'success',
            'full_name' => $full_name,
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'address' => $address,
            'gender' => $gender,
            'email' => $email,
            'username' => $username
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
?>