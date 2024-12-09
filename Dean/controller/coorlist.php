<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $deanUserId = $_SESSION['user_id'];

    // Fetch the departments handled by the dean
    $deptQuery = "
        SELECT d.department_id, d.department_name
        FROM department d
        WHERE d.dean_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }
    $deptStmt->bind_param('i', $deanUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result();
    $departments = $deptResult->fetch_all(MYSQLI_ASSOC);

    if (empty($departments)) {
        throw new Exception('No departments found for this dean.');
    }

    $data = [];
    foreach ($departments as $dept) {
        $departmentId = $dept['department_id'];
        $departmentName = $dept['department_name'];

        // Fetch coordinators for this department and their student count
        $coordinatorQuery = "
            SELECT u.first_name AS coordinator_first_name, u.last_name AS coordinator_last_name,
                   COUNT(s.user_id) AS total_students
            FROM coordinator c
            JOIN users u ON c.user_id = u.user_id
            LEFT JOIN users s ON s.department_id = ? AND s.user_type = 'Student'
            WHERE u.department_id = ?
            GROUP BY c.user_id";
        $coordinatorStmt = $conn->prepare($coordinatorQuery);
        if (!$coordinatorStmt) {
            throw new Exception('Failed to prepare coordinator query.');
        }
        $coordinatorStmt->bind_param('ii', $departmentId, $departmentId);
        $coordinatorStmt->execute();
        $coordinatorResult = $coordinatorStmt->get_result();

        while ($row = $coordinatorResult->fetch_assoc()) {
            $data[] = [
                'department_name' => $departmentName,
                'coordinator_first_name' => $row['coordinator_first_name'],
                'coordinator_last_name' => $row['coordinator_last_name'],
                'total_students' => $row['total_students']
            ];
        }
    }

    echo json_encode(['data' => $data]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
$conn->close();
?>
