<?php
include('../../../dbconn.php');

// Set the header for JSON response
header('Content-Type: application/json');

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $department1 = $_POST['department1'];
    $department2 = $_POST['department2'];
    $department3 = $_POST['department3'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL query to insert the user into the `users` table
    $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, username, password, user_type) VALUES (?, ?, ?, ?, 'Dean')");
    $stmt->bind_param("ssss", $last_name, $first_name, $username, $hashed_password);

    if ($stmt->execute()) {
        // Get the inserted user's ID
        $user_id = $stmt->insert_id;

        // Prepare the SQL query to insert the department data into the `dean` table
        $stmt_dean = $conn->prepare("INSERT INTO dean (user_id, department_1, department_2, department_3) VALUES (?, ?, ?, ?)");
        $stmt_dean->bind_param("iiii", $user_id, $department1, $department2, $department3);

        if ($stmt_dean->execute()) {
            // Success response
            echo json_encode(['success' => true, 'message' => 'Dean assigned successfully']);
        } else {
            // Failure response for dean table insert
            echo json_encode(['success' => false, 'message' => 'Error assigning departments']);
        }
    } else {
        // Failure response for users table insert
        echo json_encode(['success' => false, 'message' => 'Error inserting user']);
    }

    // Close the statements
    $stmt->close();
    $stmt_dean->close();
    $conn->close();
}
?>