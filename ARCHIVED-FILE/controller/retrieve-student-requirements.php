<?php
include('../../../dbconn.php'); 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in as a coordinator.']);
    exit;
}

$coordinatorId = $_SESSION['user_id'];

// Get title and status filters from POST request
$titleFilter = isset($_POST['title']) ? $_POST['title'] : ''; 
$statusFilter = isset($_POST['status']) ? $_POST['status'] : 'pending'; 

// Initialize the SQL query and parameters based on the filters
if (empty($titleFilter)) {
    // No title filter provided, query based on status only
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id, sr.file_path,
                u.first_name, u.last_name
            FROM submit_requirements sr
            INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
            INNER JOIN users u ON sr.student_id = u.user_id
            WHERE r.coordinator_id = ? AND sr.status = ?";
} else {
    // If title filter is provided, include it in the query
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id, sr.file_path,
                u.first_name, u.last_name
            FROM submit_requirements sr
            INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
            INNER JOIN users u ON sr.student_id = u.user_id
            WHERE r.coordinator_id = ? AND sr.status = ? AND r.title = ?";
}

// Prepare and execute the query
if ($stmt = $conn->prepare($sql)) {
    // Bind the parameters based on whether a title filter is provided
    if (!empty($titleFilter)) {
        $stmt->bind_param("iss", $coordinatorId, $statusFilter, $titleFilter);
    } else {
        $stmt->bind_param("is", $coordinatorId, $statusFilter);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    // Fetch the results and prepare them for the response
    while ($row = $result->fetch_assoc()) {
        $requirements[] = [
            'submit_id' => $row['submit_id'],
            'document_name' => $row['document_name'],
            'status' => $row['status'],
            'submission_date' => $row['submission_date'],
            'student_name' => $row['first_name'] . ' ' . $row['last_name'],
            'student_id' => $row['student_id'],
            'file_path' => '/AIMS/Student/controller/requirement/uploads/' . basename($row['file_path']),
        ];
    }

    // Return the requirements data as JSON
    echo json_encode(['status' => 'success', 'data' => $requirements]);

    $stmt->close();
} else {
    // Handle failure to prepare the query
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
}

?>