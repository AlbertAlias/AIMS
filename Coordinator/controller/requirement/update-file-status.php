<?php
    session_start();
    include '../../../dbconn.php'; // Include database connection

    // Ensure the user is logged in as a Coordinator
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
        die(json_encode(['error' => 'Unauthorized access']));
    }

    // Get the submission ID and status from the request
    $submit_id = isset($_POST['submit_id']) ? intval($_POST['submit_id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if (!$submit_id || !in_array($status, ['approved', 'rejected'])) {
        die(json_encode(['error' => 'Invalid request']));
    }

    // Update the status in the database
    $sql = "UPDATE submit_requirements SET status = ? WHERE submit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $submit_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update status']);
    }

    $stmt->close();
    $conn->close();
?>