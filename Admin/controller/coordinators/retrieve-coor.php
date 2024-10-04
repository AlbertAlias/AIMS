<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    $sql = "SELECT u.id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN coordinators c ON u.id = c.user_id
            LEFT JOIN departments d ON c.department_id = d.id
            WHERE u.user_type = 'coordinator'";

    $result = $conn->query($sql);

    $response = [];

    if (!$result) {
        error_log("Query error: " . $conn->error);
        $response = ['success' => false, 'message' => 'Query failed: ' . $conn->error];
    } else {
        $coordinators = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $coordinators[] = $row;
            }
        }
        $response = ['success' => true, 'coordinators' => $coordinators];
    }

    echo json_encode($response);

    $conn->close();
?>