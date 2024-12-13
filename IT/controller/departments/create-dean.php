<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Start output buffering
ob_start();

include('../../../dbconn.php'); // Ensure this path is correct

// Debugging: Log incoming data
file_put_contents('debug_log.txt', "POST data received: " . json_encode($_POST) . "\n", FILE_APPEND);

$response = []; // Prepare a response array

try {
    // Validate required fields
    if (!isset($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['password'], $_POST['department1'])) {
        throw new Exception('Missing required fields.');
    }

    // Sanitize inputs
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT); // Hash password
    $department1 = $_POST['department1'];
    $department2 = !empty($_POST['department2']) ? $_POST['department2'] : null;
    $department3 = !empty($_POST['department3']) ? $_POST['department3'] : null;

    // Check if username already exists
    $check_username_sql = "SELECT user_id FROM users WHERE username = '$username'";
    $result = $conn->query($check_username_sql);
    if ($result->num_rows > 0) {
        // Username already exists, return an error response
        throw new Exception('Username already exists');
    }

    // Insert dean into users table
    $sql = "INSERT INTO users (last_name, first_name, username, password, user_type) 
            VALUES ('$last_name', '$first_name', '$username', '$password', 'Dean')";
    if (!$conn->query($sql)) {
        throw new Exception("Error inserting dean: " . $conn->error);
    }

    $dean_id = $conn->insert_id;

    // Assign departments
    $departments = [$department1, $department2, $department3];
    foreach ($departments as $department_id) {
        if (!empty($department_id)) {
            $dept_sql = "INSERT INTO dean_department (dean_id, department_id) VALUES ('$dean_id', '$department_id')";
            if (!$conn->query($dept_sql)) {
                throw new Exception("Error assigning department: " . $conn->error);
            }
        }
    }

    // Prepare a success response
    $response['success'] = true;
} catch (Exception $e) {
    // Log error and prepare error response
    file_put_contents('debug_log.txt', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

// Clean the output buffer
ob_end_clean();

// Send JSON response
echo json_encode($response);
$conn->close();
?>
