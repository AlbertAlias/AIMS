<?php
include '../../../dbconn.php';

$id = $_POST['id'];

$sql = "SELECT * FROM users_acc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo json_encode($user);
?>