<?php
require_once '../../../dbconn.php';

// Query to fetch department data
$sql = "SELECT id, department_name FROM departments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
    // Return the departments data as JSON
    echo json_encode(['departments' => $departments]);
} else {
    // If no departments are found, return an empty array
    echo json_encode(['departments' => []]);
}

// Close the database connection
$conn->close();
?>