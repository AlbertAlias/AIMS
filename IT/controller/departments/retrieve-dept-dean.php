<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Adjusted SQL query based on the provided schema
    $sql = "SELECT departments.id AS id, departments.department_name AS name, 
                CONCAT(users.first_name, ' ', users.last_name) AS head
            FROM departments
            INNER JOIN dean ON departments.dean_id = dean.id
            INNER JOIN users ON dean.user_id = users.id";

    $result = $conn->query($sql);

    $response = [];

    if (!$result) {
        $response = ['success' => false, 'message' => 'Query failed'];
    } else {
        $departments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['name'] = trim($row['name']); // Remove extra whitespace
                $departments[] = $row;
            }
        }
        $response = ['success' => true, 'departments' => $departments];
    }

    echo json_encode($response);

    $conn->close();
?>