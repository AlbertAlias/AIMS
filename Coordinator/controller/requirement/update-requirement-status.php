<?php
include('../../../dbconn.php'); 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in as a coordinator.']);
    exit;
}

$coordinatorId = $_SESSION['user_id'];
$submitId = $_POST['submit_id'];
$status = $_POST['status'];
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : null;

// Validate inputs
if (empty($submitId) || empty($status)) {
    echo json_encode(['status' => 'error', 'message' => 'Submission ID and status are required.']);
    exit;
}

// If rejecting, remarks are mandatory
if ($status === 'rejected' && empty($remarks)) {
    echo json_encode(['status' => 'error', 'message' => 'Remarks are required when rejecting a submission.']);
    exit;
}

// SQL query to update the status and optionally remarks
$sql = "UPDATE submit_requirements 
        SET status = ?, remarks = ? 
        WHERE submit_id = ? AND status = 'pending'";

if ($stmt = $conn->prepare($sql)) {
    $remarksToSave = $status === 'approved' ? null : $remarks;
    $stmt->bind_param("ssi", $status, $remarksToSave, $submitId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Submission updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update submission status.']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
}
?>