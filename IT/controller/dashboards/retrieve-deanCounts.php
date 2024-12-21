<?php
    include '../../../dbconn.php';

    header('Content-Type: application/json');

    // Query to count deans directly from the users table
    $sql = "
        SELECT COUNT(*) AS count
        FROM users
        WHERE user_type = 'Dean'
    ";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['count' => $row['count']]);
    } else {
        // Include error details for debugging (remove in production)
        echo json_encode(['count' => 0, 'error' => $conn->error]);
    }

    $conn->close();
?>