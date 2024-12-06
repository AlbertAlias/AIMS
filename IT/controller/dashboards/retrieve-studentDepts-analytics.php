<?php
    include '../../../dbconn.php';
    header('Content-Type: application/json');

    // Correct SQL query to count students per department
    $query = "SELECT dd.department_name AS department, COUNT(u.id) AS student_count
        FROM department_dean dd
        LEFT JOIN users u ON dd.id = u.department_id AND u.user_type = 'student'
        GROUP BY dd.department_name
    ";

    $result = $conn->query($query);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['department']] = (int)$row['student_count'];
        }
    } else {
        $data = []; // Ensure it's always an array, even if no data found
    }

    $conn->close();
    echo json_encode($data);
?>