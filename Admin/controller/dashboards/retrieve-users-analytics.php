<?php
    include '../../../dbconn.php';

    $query = "SELECT user_type, COUNT(*) as count FROM users WHERE user_type IN ('admin', 'sub-admin', 'coordinator', 'intern') GROUP BY user_type";
    $result = $conn->query($query);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['user_type']] = (int)$row['count'];
        }
    }

    $conn->close();
    echo json_encode($data);
?>
