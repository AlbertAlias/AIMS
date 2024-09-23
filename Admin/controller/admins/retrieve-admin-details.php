<?php
header('Content-Type: application/json');
require_once '../../../dbconn.php';

$id = $_GET['id']; // Ensure you sanitize this input
$query = "SELECT *, password AS hashed_password FROM admins WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    // Log the admin data for debugging
    error_log(print_r($admin, true));
    echo json_encode($admin);
} else {
    echo json_encode(['error' => 'Admin not found']);
}

$stmt->close();
$conn->close();
?>