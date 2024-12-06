<?php
include '../../dbconn.php';
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM student_requirements ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$requirements = [];

while ($row = $result->fetch_assoc()) {
    $requirements[] = $row;
}

echo json_encode($requirements);
?>
