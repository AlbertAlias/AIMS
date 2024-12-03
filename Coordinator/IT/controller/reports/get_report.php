<?php
// Include your database connection
include('../../../../dbconn.php');

// Set response headers
header('Content-Type: application/json');

try {
    // Validate the input
    if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
        echo json_encode(['error' => 'Student ID is required']);
        exit;
    }

    // Sanitize input
    $student_id = htmlspecialchars($_GET['student_id'], ENT_QUOTES, 'UTF-8');

    // Prepare the query
    $query = $conn->prepare("SELECT report, status FROM weekly_reports WHERE student_id = ?");
    $query->bind_param("s", $studentId);

    // Execute the query
    $query->execute();
    $result = $query->get_result();

    // Check if a report exists
    if ($result->num_rows > 0) {
        $reportData = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'report' => $reportData['report'],
            'status' => $reportData['status']
        ]);
    } else {
        echo json_encode(['error' => 'No report found for this student']);
    }

    // Close the database connection
    $query->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
}
?>