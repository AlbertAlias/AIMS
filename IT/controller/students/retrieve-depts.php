<?php
    include('../../../dbconn.php');

    // Fetch all departments
    $sql = "SELECT department_id, department_name FROM department";
    $result = $conn->query($sql);

    $response = ['success' => true, 'departments' => []]; // Default: no departments, but success is true
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response['departments'][] = [
                'department_id' => $row['department_id'],
                'department_name' => $row['department_name']
            ];
        }
    }
    $conn->close();
    echo json_encode($response);
?>
