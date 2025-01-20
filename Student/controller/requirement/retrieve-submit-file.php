<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        die(json_encode(['error' => 'You must be logged in as a student to view the file']));
    }

    $student_id = $_SESSION['user_id'];

    // Define the base upload path
    $upload_base_path = '/AIMS/Student/controller/requirement/uploads/';

    $sql = "
    SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.remarks, r.description, sr.file_path
    FROM submit_requirements sr
    LEFT JOIN requirements r ON sr.requirement_id = r.requirement_id
    WHERE sr.student_id = ?
    ORDER BY sr.submission_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $files = [];
    while ($file = $result->fetch_assoc()) {
        // Append the base path to the file path
        $file['file_path'] = $upload_base_path . basename($file['file_path']);
        $files[] = $file;
    }

    if (!empty($files)) {
        echo json_encode($files);
    } else {
        echo json_encode(['error' => 'No files submitted']);
    }

    $stmt->close();
    $conn->close();
?>