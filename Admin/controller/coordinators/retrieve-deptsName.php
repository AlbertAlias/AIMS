<?php
    require_once '../../../dbconn.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // SQL query to select department IDs and names from the departments table
    $sql = "SELECT id, department_name FROM departments";
    $result = $conn->query($sql);

    // Check if any departments are found
    if ($result->num_rows > 0) {
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row; // Collecting each department into an array
        }
        echo json_encode(['departments' => $departments]); // Returning the departments as JSON
    } else {
        echo json_encode(['departments' => []]); // Returning an empty array if no departments are found
    }

    $conn->close(); // Closing the database connection
?>