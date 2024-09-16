<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

// Retrieve the POST data
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'] ?? null;
$departmentName = $data['departmentName'] ?? '';
$departmentHead = $data['departmentHead'] ?? '';

// Basic validation
if (empty($id) || empty($departmentName) || empty($departmentHead)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all fields.',
    ]);
    exit;
}

// Prepare SQL query
$sql = "UPDATE departments SET department_name = ?, department_head = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $departmentName, $departmentHead, $id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'id' => $id,
            'departmentName' => htmlspecialchars($departmentName),
            'departmentHead' => htmlspecialchars($departmentHead),
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update data.',
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
