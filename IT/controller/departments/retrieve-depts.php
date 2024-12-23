<?php
    include '../../../dbconn.php'; // Include the database connection

    // SQL query to get departments
    $sql = "SELECT department_id, department_name FROM department";
    $result = $conn->query($sql);

    $departments = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $departments[] = $row; // Store each department in the array
        }
    }

    echo json_encode($departments); // Return the departments as JSON

    $conn->close();
?>
