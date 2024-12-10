<?php
header('Content-Type: application/json'); // Ensure response is treated as JSON
error_reporting(E_ALL);  // Report all errors
ini_set('display_errors', 1);  // Display errors

include('../../../dbconn.php'); // Database connection

// Retrieve form data, including deanID
$dean_id = $_POST['deanID']; // Retrieve deanID
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$department1 = $_POST['department1'];
$department2 = $_POST['department2'];
$department3 = $_POST['department3'];
$username = $_POST['username'];
$password = $_POST['password'];

// Encrypt the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if deanID is provided for update or new insertion
if (empty($dean_id)) {
    // Step 1: Insert the user (Dean) into the users table
    $sql = "INSERT INTO users (last_name, first_name, user_type, username, password) VALUES (?, ?, 'Dean', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $last_name, $first_name, $username, $hashed_password);

    if ($stmt->execute()) {
        $dean_id = $stmt->insert_id; // Get the ID of the newly inserted dean
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to assign dean']);
        exit();
    }
}

// Step 2: Insert or update in dean_department to assign the dean to multiple departments
$departments = [$department1, $department2, $department3];
foreach ($departments as $department_id) {
    if (!empty($department_id)) {
        // Check if the dean is already assigned to the department
        $check_sql = "SELECT * FROM dean_department WHERE dean_id = ? AND department_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $dean_id, $department_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert into dean_department if not already assigned
            $insert_dean_department_sql = "INSERT INTO dean_department (dean_id, department_id) VALUES (?, ?)";
            $insert_dean_department_stmt = $conn->prepare($insert_dean_department_sql);
            $insert_dean_department_stmt->bind_param("ii", $dean_id, $department_id);
            $insert_dean_department_stmt->execute();
        }
    }
}

// Return success response
echo json_encode(['success' => true]);

$stmt->close();
$conn->close();
?>