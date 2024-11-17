<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../dbconn.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : false;
    
        session_start(); // Start session
    
        // Check if the username exists in the users table
        $stmt = $conn->prepare("SELECT u.id, u.password, u.username, u.user_type, d.department_name 
                                    FROM users u 
                                    LEFT JOIN departments d ON u.department_id = d.id
                                    WHERE u.username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            // User found
            $stmt->bind_result($user_id, $hashed_password, $username, $user_type, $department_name);
            $stmt->fetch();
    
            // Verify password using bcrypt
            if (password_verify($password, $hashed_password)) {
                // Set session variables after successful login
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_type'] = $user_type;
    
                // Handle "Remember Me"
                if ($rememberMe) {
                    // Set a cookie for the user (valid for 30 days)
                    setcookie('remember_me', $username, time() + (86400 * 30), "/", "", true, true);
                }
    
                // Respond based on user type
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
    }
?>