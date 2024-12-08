<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/json");

// Include database connection
include '../../dbconn.php';

// Start session for user authentication
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Plain password from user input

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
        exit();
    }

    // SQL query to fetch user details based on the username
    $sql = "
        SELECT 
            user_id,
            last_name,
            first_name,
            middle_name,
            username,
            password, -- Hashed password stored in the database
            user_type,
            department_id,
            company,
            email
        FROM 
            users
        WHERE 
            username = ?
    ";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password using password_verify
        if (password_verify($password, $user['password'])) { 
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['username'] = $user['username'];

            // Return success with user details
            echo json_encode([
                'status' => 'success',
                'user_id' => $user['user_id'],
                'last_name' => $user['last_name'],
                'first_name' => $user['first_name'],
                'user_type' => $user['user_type'], // Preserve original case
                'department' => $user['department_id'], // For further routing
                'company' => $user['company'],
                'email' => $user['email']
            ]);
        } else {
            // Password does not match
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
        }
    } else {
        // Username not found
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>