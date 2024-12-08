<?php
    require_once '../../../dbconn.php';

    // Prepare and execute the SQL query to retrieve department names
    $query = "SELECT department_id, department_name FROM department";
    $result = $conn->query($query);

    if ($result) {
        // Fetch all rows from the result
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }

        // Return departments as a JSON response
        echo json_encode([
            'status' => 'success',
            'data' => $departments
        ]);
    } else {
        // Return an error response if the query failed
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to fetch departments'
        ]);
    }

    // Close the database connection
    $conn->close();
?>