<?php
header('Content-Type: application/json');
session_start();
include '../../../dbconn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
    die(json_encode(['error' => 'Unauthorized access']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submit_id = $_POST['submit_id'];

    if (empty($submit_id)) {
        die(json_encode(['error' => 'Missing required parameters']));
    }

    // Query to delete the file record
    $sql = "DELETE FROM submit_requirements WHERE submit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $submit_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to delete the file']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>