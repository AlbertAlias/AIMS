<?php
    require '../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'invalid_email_format';
            exit();
        }
    
        // Prepare a statement to prevent SQL Injection
        $stmt = $conn->prepare("SELECT password FROM users_acc WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            error_log("Password from DB: " . $hashed_password);
    
            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Start session and store session variables
                session_start();
                $_SESSION['email'] = $email;
                // Add more session variables as needed
    
                echo 'success';
            } else {
                echo 'error'; // Incorrect password
            }
        } else {
            echo 'error'; // Email not found
        }
    
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>
