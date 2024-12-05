<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Suppress error display in production
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt'); // Log errors to a file

header('Content-Type: application/json'); // Ensure JSON headers are set
include '../../../dbconn.php';

// Check database connection
if (!$conn) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.',
    ]);
    exit;
}

// Retrieve the POST data
$department_name = $_POST['department_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if (empty($department_name) || empty($last_name) || empty($first_name) || empty($username) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.',
    ]);
    exit;
}

// Prepare to insert into the 'users' table
$sql_users = "INSERT INTO users (last_name, first_name, username, password, user_type) VALUES (?, ?, ?, ?, ?)";
$stmt_users = $conn->prepare($sql_users);

if ($stmt_users) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
    $user_type = 'dean'; // Set user type to 'dean'

    // Bind parameters: last_name, first_name, username, hashed password, user_type
    $stmt_users->bind_param("sssss", $last_name, $first_name, $username, $hashed_password, $user_type);

    if ($stmt_users->execute()) {
        $user_id = $stmt_users->insert_id; // Get inserted user ID

        // Now insert into department_dean, linking to the user ID
        $sql_dean = "INSERT INTO department_dean (department_name, user_id) VALUES (?, ?)";
        $stmt_dean = $conn->prepare($sql_dean);

        if ($stmt_dean) {
            $stmt_dean->bind_param("si", $department_name, $user_id);

            if ($stmt_dean->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Department Dean created successfully.',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to insert department data.',
                ]);
            }

            $stmt_dean->close();
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to prepare department SQL query.',
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to insert user data.',
        ]);
    }

    $stmt_users->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to prepare user SQL query.',
    ]);
}

$conn->close();
?>
