<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'invalid_email_format']);
            exit();
        }

        session_start();

        // Check if the email exists in the users table
        $stmt = $conn->prepare("SELECT u.id, u.password, u.account_email, u.user_type, d.department_name 
                                FROM users u 
                                LEFT JOIN departments d ON u.department_id = d.id
                                WHERE u.account_email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User found
            $stmt->bind_result($user_id, $hashed_password, $account_email, $user_type, $department_name);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['email'] = $account_email;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_type'] = $user_type;

                // Handle login based on user_type
                if ($user_type === 'admin') {
                    echo json_encode(['status' => 'success', 'user_type' => 'Admin']);
                } elseif ($user_type === 'sub-admin') {
                    echo json_encode(['status' => 'success', 'user_type' => 'Sub-Admin']);
                } elseif ($user_type === 'coordinator') {
                    $_SESSION['department'] = $department_name;
                    echo json_encode(['status' => 'success', 'user_type' => 'Coordinator', 'department' => $department_name]);
                } elseif ($user_type === 'intern') {
                    $_SESSION['department'] = $department_name;
                    echo json_encode(['status' => 'success', 'user_type' => 'Intern', 'department' => $department_name]);
                }
            } else {
                echo json_encode(['status' => 'password_not_found']);
            }
        } else {
            echo json_encode(['status' => 'email_not_found']);
        }
        exit();
    }
?>