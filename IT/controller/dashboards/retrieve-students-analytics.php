<?php
    include('../../../dbconn.php');

    $query = "
        SELECT 
            department.department_name, 
            COUNT(users.user_id) AS total 
        FROM 
            users 
        JOIN 
            department ON users.department_id = department.department_id
        WHERE 
            users.user_type = 'Student' 
        GROUP BY 
            users.department_id
    ";

    $result = $conn->query($query);

    if (!$result) {
        echo json_encode(['error' => 'Query failed: ' . $conn->error]);
        exit;
    }

    if ($result->num_rows > 0) {
        $studentData = [];
        while($row = $result->fetch_assoc()) {
            $studentData[] = [
                'department_name' => $row['department_name'],
                'total' => $row['total']
            ];
        }
        echo json_encode($studentData);
    } else {
        echo json_encode(['error' => 'No data found']);
    }

    $conn->close();
?>