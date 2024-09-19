<?php
// delete-depts.php
include '../../../dbconn.php'; // Adjust to your database connection file

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id']; // Expecting JSON data with an 'id' field

$query = "DELETE FROM departments WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
\