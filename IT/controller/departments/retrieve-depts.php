<?php
    require_once "../../../dbconn.php";

    $query = "
        SELECT department.department_id, department.department_name
        FROM department
        LEFT JOIN dean_department ON department.department_id = dean_department.department_id
        WHERE dean_department.dean_id IS NULL
        ORDER BY department.department_name ASC
    ";

    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $departments = [];
            while ($row = $result->fetch_assoc()) {
                $departments[] = [
                    "id" => $row['department_id'],
                    "name" => $row['department_name']
                ];
            }
            echo json_encode(['success' => true, 'data' => $departments]);
        } else {
            // No departments available
            echo json_encode(['success' => true, 'data' => []]);
        }
    } else {
        // Query error
        echo json_encode(['success' => false, 'error' => "Query failed: " . $conn->error]);
    }

    $conn->close();
?>