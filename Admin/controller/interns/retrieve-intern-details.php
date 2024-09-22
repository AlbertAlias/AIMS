<?php
header('Content-Type: application/json');
require_once '../../../dbconn.php';

$id = $_GET['id']; // Ensure you are sanitizing this input
$query = "SELECT *, password AS hashed_password, studentID FROM interns WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $intern = $result->fetch_assoc();
    // Hash the password using bcrypt
    $intern['password'] = password_hash($intern['hashed_password'], PASSWORD_BCRYPT);
    echo json_encode($intern);
} else {
    echo json_encode(['error' => 'Intern not found']);
}

$stmt->close();
$conn->close();
?>