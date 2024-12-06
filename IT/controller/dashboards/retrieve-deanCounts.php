<?php
    include '../../../dbconn.php';

    header('Content-Type: application/json');

    // Query to count deans
    $sql = "SELECT COUNT(*) AS count
        FROM department_dean dd
        INNER JOIN users u ON dd.user_id = u.id
        WHERE u.user_type = 'dean'
    ";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['count' => $row['count']]);
    } else {
        echo json_encode(['count' => 0, 'error' => $conn->error]); // Include error for debugging
    }

    $conn->close();
?>