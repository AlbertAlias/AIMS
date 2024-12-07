<?php
include '../../../dbconn.php'; // Include the database connection

// Check if the required POST variables are set
if (isset($_POST['username']) && isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['department_id'])) {
    // Sanitize the input values to avoid SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $department_id = (int) $_POST['department_id']; // Cast to integer for department_id

    // Ensure that the department_id exists in the departments table
    $checkDeptQuery = "SELECT id FROM departments WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkDeptQuery)) {
        $checkStmt->bind_param("i", $department_id);
        $checkStmt->execute();
        $checkStmt->store_result();

        // If no department is found with the given department_id
        if ($checkStmt->num_rows === 0) {
            echo json_encode(['error' => 'Department ID does not exist in the departments table.']);
            $checkStmt->close();
            $conn->close();
            exit;
        }
        $checkStmt->close();
    } else {
        echo json_encode(['error' => 'Failed to check department existence.']);
        $conn->close();
        exit;
    }

    // Prepare the SQL query to update the department_id for the given username, first_name, and last_name
    $sql = "UPDATE users SET department_id = ? WHERE username = ? AND last_name = ? AND first_name = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("isss", $department_id, $username, $last_name, $first_name);

        // Execute the query
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'No matching user found with the provided details or department_id already set.']);
            }
        } else {
            echo json_encode(['error' => 'Failed to execute the update query: ' . mysqli_error($conn)]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the SQL query']);
    }
} else {
    echo json_encode(['error' => 'Invalid input data']);
}

// Close the database connection
$conn->close();
?>