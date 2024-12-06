<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once '../../../dbconn.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID provided']);
    exit();
}

$studentId = $_GET['id'];

$sql = "SELECT id, first_name, last_name FROM students WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['error' => 'Query preparation failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param('i', $studentId);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Query execution failed']);
} else {
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(['error' => 'No student found']);
    } else {
        echo json_encode($result->fetch_assoc());
    }
}

$stmt->close();
$conn->close();
?>
