<?php
    include '../../../dbconn.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        exit();
    }

    $student_id = $_SESSION['user_id'];

    $upload_base_path = '/AIMS/Student/controller/requirement/uploads/';

    $sql = "
        SELECT document_name, submission_date, file_path, status 
        FROM submit_requirements 
        WHERE student_id = ? AND status = 'approved'
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['file_path'] = $upload_base_path . basename($row['file_path']);
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['status' => 'success', 'data' => $data]);
?>
