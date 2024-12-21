<?php
    include '../../../dbconn.php';

    header('Content-Type: application/json');

    // Query to count coordinators directly from the users table
    $sql = "
        SELECT COUNT(*) AS count
        FROM users
        WHERE user_type = 'Coordinator'
    ";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['count' => $row['count']]);
    } else {
        // Include error details for debugging (optional, remove in production)
        echo json_encode(['count' => 0, 'error' => $conn->error]);
    }

    $conn->close();
?>