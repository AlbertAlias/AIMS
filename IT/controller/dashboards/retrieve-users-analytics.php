<?php
    include '../../../dbconn.php';
    header('Content-Type: application/json');

    // Correct SQL query to count users by user_type
    $query = "SELECT user_type, COUNT(*) as count 
        FROM users 
        WHERE user_type IN ('it', 'registrar', 'dean', 'coordinator') 
        GROUP BY user_type
    ";

    $result = $conn->query($query);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['user_type']] = (int)$row['count'];
        }
    } else {
        // If no data, initialize all counts as 0
        $data = [
            'it' => 0,
            'registrar' => 0,
            'dean' => 0,
            'coordinator' => 0
        ];
    }

    $conn->close();
    echo json_encode($data);
?>