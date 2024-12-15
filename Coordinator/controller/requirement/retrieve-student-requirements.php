<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Query to fetch the requirements for all statuses
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date
            FROM submit_requirements sr
            WHERE sr.student_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the results and prepare them for the AJAX response
        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = [
                'submit_id' => $row['submit_id'],
                'document_name' => $row['document_name'],
                'status' => $row['status'],
                'submission_date' => $row['submission_date']
            ];
        }

        if (count($requirements) > 0) {
            echo json_encode(['status' => 'success', 'data' => $requirements]);
        } else {
            echo json_encode(['status' => 'success', 'data' => []]); // Empty data array
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database query failed']);
    }
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>