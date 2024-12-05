<?php
// Start session for user authentication
session_start();

// Include database connection
include_once('../../dbconn.php');

// Get the input values (username and password)
$username = $_POST['username'];
$password = $_POST['password'];

// Check if both fields are provided
if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required.']);
    exit();
}

// SQL Query to fetch user details based on the provided
$query = "SELECT u.*, d.department_name FROM users u 
          LEFT JOIN dept_dean d ON u.department_id = d.id
          WHERE u.username = ? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the password using bcrypt (password_verify)
    if (password_verify($password, $user['password'])) {

        // Set session or token for authenticated user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['department'] = $user['department_name'];

        // Send success response with user type and department
        echo json_encode([
            'status' => 'success',
            'user_type' => $user['user_type'],
            'department' => $user['department_name']
        ]);
    } else {
        // Invalid password
        echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
    }
} else {
    // User not found
    echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
}

$stmt->close();
$conn->close();
?>