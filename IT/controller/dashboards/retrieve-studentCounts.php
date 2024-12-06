<?php
    include '../../../dbconn.php';

    header('Content-Type: application/json');

    // Correct query to count students
    $sql = "
        SELECT COUNT(*) AS count 
        FROM students s
        INNER JOIN users u ON s.user_id = u.id
        WHERE u.user_type = 'student'
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
