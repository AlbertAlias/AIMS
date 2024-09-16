<?php
header('Content-Type: application/json');
include '../../../dbconn.php'; // Include your database connection file

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM coordinators WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Coordinator deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting coordinator: ' . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
}

$conn->close();
?>
