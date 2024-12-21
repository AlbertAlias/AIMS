<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../dbconn.php';

    header('Content-Type: application/json');

    // Correct SQL query with proper alias for the count
    $sql = "SELECT COUNT(*) AS department_count FROM department_dean";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['count' => $row['department_count']]); // Fixed key
    } else {
        // Added error details for debugging
        echo json_encode(['count' => 0, 'error' => $conn->error]);
    }

    $conn->close();
?>