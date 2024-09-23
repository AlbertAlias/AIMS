<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    error_log("Checking email: " . $email);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'invalid_email_format']);
        exit();
    }

    session_start();

    // Check Admins and Sub-Admins (based on role column)
    $stmt = $conn->prepare("SELECT id, password, role FROM admins WHERE account_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $id;
            
            if ($role === 'Admin') {
                $_SESSION['user_type'] = 'Admin';
                echo json_encode(['status' => 'success', 'user_type' => 'Admin']);
            } elseif ($role === 'Sub-Admin') {
                $_SESSION['user_type'] = 'Sub-Admin';
                echo json_encode(['status' => 'success', 'user_type' => 'Sub-Admin']);
            }
            exit();
        }
    }

    // Check Coordinators table
    $stmt = $conn->prepare("SELECT id, password, department FROM coordinators WHERE account_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $department);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = 'Coordinator';
            $_SESSION['user_id'] = $id;
            $_SESSION['department'] = $department;
            echo json_encode(['status' => 'success', 'user_type' => 'Coordinator', 'department' => $department]);
            exit();
        }
    }

    // Check Interns table
    $stmt = $conn->prepare("SELECT id, password, department FROM interns WHERE account_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $department);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = 'Intern';
            $_SESSION['user_id'] = $id;
            $_SESSION['department'] = $department;
            echo json_encode(['status' => 'success', 'user_type' => 'Intern', 'department' => $department]);
            exit();
        }
    }

    // If no match found, return error
    echo json_encode(['status' => 'invalid_credentials']);
    exit();
}
?>