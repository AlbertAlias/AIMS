<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php';  // Include the database connection

    // Ensure the student is logged in (based on session)
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        die(json_encode(['error' => 'You must be logged in as a student to view the file']));
    }

    // Get the student ID from the session
    $student_id = $_SESSION['user_id'];  // Assuming the student's ID is stored in the session

    // Query to get all file submissions for the logged-in student, ordered by submission_date DESC
    $sql = "
    SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.remarks, r.description
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