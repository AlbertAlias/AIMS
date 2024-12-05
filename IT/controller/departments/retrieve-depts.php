<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Adjust SQL query according to the actual table schema
        $sql = "SELECT dept_dean.id AS id, dept_dean.department_name AS name, 
            CONCAT(users.first_name, ' ', users.last_name) AS head
            FROM dept_dean
            INNER JOIN users ON dept_dean.user_id = users.id
        ";

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