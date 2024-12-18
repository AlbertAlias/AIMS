<?php
include('../../../dbconn.php'); 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in as a coordinator.']);
    exit;
}

$coordinatorId = $_SESSION['user_id'];
$titleFilter = isset($_POST['title']) ? $_POST['title'] : ''; // Get the title filter from the POST request

// SQL query to retrieve student requirements along with file paths
if (empty($titleFilter)) {
    // Modify the query to return all requirements if no title filter is provided
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id, sr.file_path,
                u.first_name, u.last_name
            FROM submit_requirements sr
            INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
            INNER JOIN users u ON sr.student_id = u.user_id
            WHERE r.coordinator_id = ? AND sr.status = 'pending'";
} else {
    // Filter by title if it's provided
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id, sr.file_path,
                u.first_name, u.last_name
            FROM submit_requirements sr
            INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
            INNER JOIN users u ON sr.student_id = u.user_id
            WHERE r.coordinator_id = ? AND sr.status = 'pending' AND r.title = ?";
}

// Prepare and execute the statement
if ($stmt = $conn->prepare($sql)) {
    if (!empty($titleFilter)) {
        // Bind the coordinatorId and titleFilter when title is provided
        $stmt->bind_param("is", $coordinatorId, $titleFilter);
    } else {
        // Only bind the coordinatorId if no title filter
        $stmt->bind_param("i", $coordinatorId);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
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

    if (count($requirements) > 0) {
        echo json_encode(['status' => 'success', 'data' => $requirements]);
    } else {
        echo json_encode(['status' => 'success', 'data' => []]); // No data found
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
}
?>