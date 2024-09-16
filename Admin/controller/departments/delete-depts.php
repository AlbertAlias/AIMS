<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

// Retrieve the DELETE data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if (empty($id)) {
    echo json_encode([
        'success' => false,
        'message' => 'Department ID is missing.',
    ]);
    exit;
}

// Prepare SQL query
$sql = "DELETE FROM departments WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Department deleted successfully.',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete department.',
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to prepare SQL query.',
    ]);
}

$conn->close();
?>
