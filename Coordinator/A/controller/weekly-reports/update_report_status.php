<?php
// Include your database connection
include('../../../../dbconn.php');

$data = json_decode(file_get_contents('php://input'), true);
$student_id = $data['student_id'];
$action = $data['action'];
$status = ($action === 'approve') ? 'Approved' : 'Disapproved';

$query = "UPDATE weekly_reports SET status = ? WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $status, $studentId);
$success = $stmt->execute();
$stmt->close();

header('Content-Type: application/json');
echo json_encode(['success' => $success]);
?>