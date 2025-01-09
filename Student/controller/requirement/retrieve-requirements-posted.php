<?php
    include '../../../dbconn.php';
    session_start();

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['department_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $student_department_id = $_SESSION['department_id'];

    $sql = "
        SELECT 
            r.requirement_id,
            CONCAT(u.first_name, ' ', u.last_name) AS full_name,
            r.title,
            r.description,
            r.deadline,
            r.status AS requirement_status
        FROM 
            requirements r
        JOIN 
            users u ON r.coordinator_id = u.user_id
        LEFT JOIN 
            submit_requirements sr ON r.requirement_id = sr.requirement_id AND sr.student_id = ?
        WHERE 
            u.department_id = ? 
            AND (sr.status IS NULL OR sr.status = 'rejected') 
            AND r.status = 'open'
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_SESSION['user_id'], $student_department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = $row;
    }

    echo json_encode($requirements);

    $stmt->close();
    $conn->close();
?>
