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
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
            exit();
        }

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

    $stmt = $conn->prepare("
        SELECT 
            u.last_name, u.first_name, u.middle_name, u.address, u.gender, u.email, u.username,
            ss.company, u.company_address, CONCAT(s.first_name, ' ', s.last_name) AS supervisor
        FROM users u
        LEFT JOIN student_supervisor ss ON u.user_id = ss.student_id
        LEFT JOIN users s ON ss.supervisor_id = s.user_id
        WHERE u.username = ?
    ");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param('s', $user_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result(
            $last_name, $first_name, $middle_name, $address, $gender, $email, $username,
            $company, $company_address, $supervisor
        );
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
            'username' => $username,
            'company' => $company,
            'company_address' => $company_address,
            'supervisor' => $supervisor
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
?>