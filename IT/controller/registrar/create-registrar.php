<?php
// Include database connection
require_once '../../../dbconn.php';

// Set response header
header('Content-Type: application/json');

// Capture form data from AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = $conn->real_escape_string(trim($_POST['registrar_last_name']));
    $first_name = $conn->real_escape_string(trim($_POST['registrar_first_name']));
    $email = $conn->real_escape_string(trim($_POST['registrar_personal_email']));
    $username = $conn->real_escape_string(trim($_POST['registrar_username']));
    $password = password_hash(trim($_POST['registrar_password']), PASSWORD_BCRYPT); // Secure password hashing

    // Validate required fields
    if (empty($last_name) || empty($first_name) || empty($email) || empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Check if username already exists
    $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Username already exists. Please choose another.']);
        exit;
    }

    // Insert Registrar into the database
    $query = "INSERT INTO users (last_name, first_name, email, username, password, user_type) 
              VALUES (?, ?, ?, ?, ?, 'Registrar')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $last_name, $first_name, $email, $username, $password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>