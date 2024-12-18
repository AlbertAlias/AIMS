<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Fetch the requirements from the database
    $sql = "SELECT requirement_id, title, description, deadline, status FROM requirements ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = [
            'requirement_id' => $row['requirement_id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'deadline' => $row['deadline'],
            'status' => $row['status']
        ];
    }

    // Return the requirements as a JSON object
    echo json_encode([
        'success' => true,
        'requirements' => $requirements
    ]);
?>