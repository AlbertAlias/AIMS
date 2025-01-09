<?php
    include('../../../dbconn.php');

    $query = "SELECT user_type, COUNT(user_id) AS total FROM users GROUP BY user_type";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $userData = [];
        while($row = $result->fetch_assoc()) {
            $userData[$row['user_type']] = $row['total'];
        }
        echo json_encode($userData);
    } else {
        echo json_encode(['error' => 'No data found']);
    }

    $conn->close();
?>