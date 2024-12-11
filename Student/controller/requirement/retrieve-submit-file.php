<?php
    session_start();
    include '../../../dbconn.php';  // Include the database connection

    // Ensure the student is logged in (based on session)
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        die(json_encode(['error' => 'You must be logged in as a student to view the file']));
    }

    // Get the student ID from the session
    $student_id = $_SESSION['user_id'];  // Assuming the student's ID is stored in the session

    // Query to get the file submission for the logged-in student
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status
            FROM submit_requirements sr
            WHERE sr.student_id = ?";

    // Prepare the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);  // Bind student_id to the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the student has submitted a file
    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();
        echo json_encode([
            'document_name' => $file['document_name'],
            'status' => $file['status']
        ]);
    } else {
        echo json_encode(['error' => 'No file submitted']);
    }

    $stmt->close();
    $conn->close();
?>