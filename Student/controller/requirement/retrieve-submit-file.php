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

    // Query to get the file submission for the logged-in student
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date
        FROM submit_requirements sr
        WHERE sr.student_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();
        echo json_encode([
            'document_name' => $file['document_name'],
            'status' => $file['status'],
            'submission_date' => $file['submission_date']
        ]);
        exit;
    } else {
        echo json_encode(['error' => 'No file submitted']);
    }

    $stmt->close();
    $conn->close();
?>