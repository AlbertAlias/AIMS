<?php
    header("Content-Type: application/json");
    include '../../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        session_start();
        $dean_id = $_SESSION['user_id'];

        $sql = "
            SELECT d.department_id, d.department_name, 
                (SELECT COUNT(*) FROM users u WHERE u.user_type = 'Coordinator' AND u.department_id = d.department_id) AS coordinators_count,
                (SELECT COUNT(*) FROM users u WHERE u.user_type = 'Student' AND u.department_id = d.department_id) AS students_count
            FROM department d
            INNER JOIN dean_department dd ON dd.department_id = d.department_id
            WHERE dd.dean_id = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $dean_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'department_id' => $row['department_id'],
                'department_name' => $row['department_name'],
                'coordinators_count' => (int)$row['coordinators_count'],
                'students_count' => (int)$row['students_count']
            ];
        }

        echo json_encode($data);
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }
?>