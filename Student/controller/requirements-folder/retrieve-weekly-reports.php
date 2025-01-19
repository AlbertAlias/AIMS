<?php
    header("Content-Type: application/json");
    include '../../../dbconn.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $sql = "
        SELECT title, week_start, week_end, file_path 
        FROM weekly_reports 
        WHERE student_id = ?
        ORDER BY week_start ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $upload_base_path = '/AIMS/Student/controller/weeklyreport/uploads/';
        $row['file_path'] = $upload_base_path . basename($row['file_path']);
        $reports[] = $row;
    }

    $stmt->close();
    $conn->close();

    // Return the data as JSON
    echo json_encode(['status' => 'success', 'data' => $reports]);
?> 