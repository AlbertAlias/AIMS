<?php
    include('../../../dbconn.php');  // Include your database connection

    // Fetch departments from the database
    $sql = "SELECT department_id, department_name FROM department";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Prepare an array to store department data
        $departments = array();
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }

        // Return data as JSON
        echo json_encode(['success' => true, 'departments' => $departments]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No departments found']);
    }

    // Close the database connection
    $conn->close();
?>