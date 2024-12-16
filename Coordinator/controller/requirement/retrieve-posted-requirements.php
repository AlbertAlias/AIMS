<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Fetch the requirements from the database
    $sql = "SELECT title, description, deadline FROM requirements ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = [
            'title' => $row['title'],
            'description' => $row['description'],
            'deadline' => $row['deadline']
        ];
    }

    // Return the requirements as a JSON object
    echo json_encode([
        'success' => true,
        'requirements' => $requirements
    ]);
?>
