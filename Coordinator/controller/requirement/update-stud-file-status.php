<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submissionId = $_POST['submissionId'];
    $status = $_POST['status'];

    // Check if the required data is provided
    if (empty($submissionId) || empty($status)) {
        echo json_encode(["success" => false, "error" => "Missing submission ID or status"]);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE submit_requirements SET status = ? WHERE submit_id = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Failed to prepare statement"]);
        exit;
    }

    $stmt->bind_param('si', $status, $submissionId);

    if ($stmt->execute()) {
        // Check if rows were affected
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "No rows affected"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Failed to execute query"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>