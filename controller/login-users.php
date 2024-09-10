<?php
require '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'invalid_email_format']);
        exit();
    }

    // Prepare a statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT password, user_type, department FROM users_acc WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $user_type, $department);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start session and store session variables
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['department'] = $department;

            echo json_encode(['status' => 'success', 'user_type' => $user_type, 'department' => $department]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'invalid_credentials']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'user_not_found']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>