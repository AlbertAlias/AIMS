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

    // Initialize variables
    $account_email = null;
    $hashed_password = null;
    $department = null;
    $role = null;

    // Check if the email exists in the admins table
    $stmt = $conn->prepare("SELECT id, password, account_email FROM admins WHERE account_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Admin found
        $stmt->bind_result($id, $hashed_password, $account_email);
        $stmt->fetch();
        $role = 'Admin';
    } else {
        // No admin found, check coordinators
        $stmt = $conn->prepare("SELECT id, password, account_email, department FROM coordinators WHERE account_email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Coordinator found
            $stmt->bind_result($id, $hashed_password, $account_email, $department);
            $stmt->fetch();
            $role = 'Coordinator';
        } else {
            // No admin or coordinator found, check interns
            $stmt = $conn->prepare("SELECT id, password, account_email, department FROM interns WHERE account_email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Intern found
                $stmt->bind_result($id, $hashed_password, $account_email, $department);
                $stmt->fetch();
                $role = 'Intern';
            } else {
                // Email not found in any table
                echo json_encode(['status' => 'email_not_found']);
                exit();
            }
        }
    }

    // Verify password
    if (isset($hashed_password) && password_verify($password, $hashed_password)) {
        $_SESSION['email'] = $account_email; // Set the account email in the session
        $_SESSION['user_id'] = $id;

        if ($role === 'Admin') {
            $_SESSION['user_type'] = 'Admin';
            echo json_encode(['status' => 'success', 'user_type' => 'Admin']);
        } elseif ($role === 'Coordinator') {
            $_SESSION['user_type'] = 'Coordinator';
            $_SESSION['department'] = $department; // Fetch the department
            echo json_encode(['status' => 'success', 'user_type' => 'Coordinator', 'department' => $department]);
        } elseif ($role === 'Intern') {
            $_SESSION['user_type'] = 'Intern';
            $_SESSION['department'] = $department; // Make department available
            echo json_encode(['status' => 'success', 'user_type' => 'Intern', 'department' => $department]);
        }
    } else {
        // Invalid password
        echo json_encode(['status' => 'password_not_found']);
    }
    exit();
}
?>