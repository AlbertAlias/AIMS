<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../../../dbconn.php');

    // Query to select only department names from the department table
    $query = "SELECT department_name FROM department WHERE dean_id IS NOT NULL";

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare the query.'
        ]);
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any result is found
    if ($result->num_rows > 0) {
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = [
                'department_name' => $row['department_name']
            ];
        }

        echo json_encode([
            'success' => true,
            'departments' => $departments
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No departments found with a dean.'
        ]);
    }
?>