<?php
    include '../../../dbconn.php';

    header('Content-Type: application/json');

    $sql = "
        SELECT COUNT(*) AS count
        FROM users
        WHERE user_type = 'Student'
    ";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['count' => $row['count']]);
    } else {
        // Provide error details for debugging
        echo json_encode(['count' => 0, 'error' => $conn->error]);
    }

    $conn->close();
?>
