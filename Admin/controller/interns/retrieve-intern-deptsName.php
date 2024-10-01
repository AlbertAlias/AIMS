<?php
    include '../../../dbconn.php';  // Ensure this includes your database connection

    header('Content-Type: application/json');

    $sql = "SELECT id, department_name FROM departments";
    $result = $conn->query($sql);

    if ($result) {
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $departments]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error retrieving department names: ' . $conn->error]);
    }

    $conn->close();  // Close the database connection
?>