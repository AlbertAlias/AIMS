<?php
    include('../../../dbconn.php');

    // SQL Query to get coordinators' information
    $sql = "SELECT u.user_id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Student'";

    $result = $conn->query($sql);

    $response = ['success' => true, 'students' => []]; // Default: no students, but success is true
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student = [
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'department_name' => $row['department_name']
            ];
            $response['students'][] = $student;
        }
    }
    $conn->close();
    echo json_encode($response);
?>