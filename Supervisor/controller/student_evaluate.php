<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $supervisorUserId = $_SESSION['user_id'];
    $studentId = $_POST['studentId'] ?? null;
    $remarks = $_POST['remarks'] ?? '';

    if (!$studentId || !$remarks) {
        throw new Exception('Missing required fields.');
    }

    // Insert evaluation into database
    $query = "INSERT INTO evaluations (supervisor_id, student_id, remarks, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception('Failed to prepare the evaluation query.');
    }
    $stmt->bind_param('iis', $supervisorUserId, $studentId, $remarks);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('Failed to insert evaluation.');
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>
