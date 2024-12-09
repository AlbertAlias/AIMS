<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submissionId = intval($_POST['submission_id']);
    $action = $_POST['action'];
    $message = $_POST['message'] ?? '';

    if ($action === 'approve') {
        $stmt = $conn->prepare("UPDATE student_submissions SET status = 'approved', review_message = NULL WHERE id = ?");
    } elseif ($action === 'disapprove') {
        $stmt = $conn->prepare("UPDATE student_submissions SET status = 'disapproved', review_message = ? WHERE id = ?");
        $stmt->bind_param('si', $message, $submissionId);
    } else {
        echo json_encode(["success" => false, "error" => "Invalid action"]);
        exit;
    }

    $stmt->bind_param('i', $submissionId);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Database error"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
