<?php
    include('../../../dbconn.php');

    session_start();
    $department_id = $_SESSION['department_id'];

    $query = "
        SELECT sh.hours_needed
        FROM student_hours sh
        JOIN users u ON sh.coordinator_id = u.user_id
        WHERE u.department_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $hours_needed = 480;

    $segments = [];
    $step = $hours_needed / 4;
    for ($i = 0; $i < 4; $i++) {
        $segments[] = $step * ($i + 1);
    }

    $query = "
        SELECT oh.student_id, SUM(oh.total_hours) AS total_hours
        FROM ojt_hours oh
        JOIN users u ON oh.student_id = u.user_id
        WHERE u.department_id = ?
        GROUP BY oh.student_id";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $counts = [0, 0, 0, 0];

    while ($row = $result->fetch_assoc()) {
        $total_hours = (int)$row['total_hours'];

        for ($i = 0; $i < 4; $i++) {
            if ($total_hours <= $segments[$i]) {
                $counts[$i]++;
                break;
            }
        }
    }

    // Return the data as JSON
    echo json_encode([
        'segments' => $segments,
        'counts' => $counts
    ]);

    $conn->close();
?>