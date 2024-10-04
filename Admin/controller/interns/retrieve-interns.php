<?php
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    error_reporting(E_ALL);
    ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/php-error.log');

    header('Content-Type: application/json');
    require_once '../../../dbconn.php';

    $query = "SELECT interns.id, users.last_name, users.first_name, interns.studentID, departments.department_name
              FROM interns
              INNER JOIN users ON interns.user_id = users.id
              LEFT JOIN departments ON users.department_id = departments.id
              WHERE users.user_type = 'intern'";

    $result = $conn->query($query);

    if (!$result) {
        error_log("Database query failed: " . $conn->error);
        echo json_encode(['error' => 'Failed to retrieve interns: ' . $conn->error]);
        exit;
    }

    $interns = [];
    while ($row = $result->fetch_assoc()) {
        $interns[] = $row;
    }

    echo json_encode($interns);
    $conn->close();
?>