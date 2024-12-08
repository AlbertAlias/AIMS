<?php
    require_once '../../../dbconn.php';

    // Query to get department names where dean_id is NULL
    $query = "SELECT id, department_name FROM departments WHERE dean_id IS NULL";
    $result = $conn->query($query);

    $departments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
    }

    // Return the departments as a JSON response
    echo json_encode($departments);
?>