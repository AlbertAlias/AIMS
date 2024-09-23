<?php
include '../../../dbconn.php';

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$department = $_POST['department'];
$company = $_POST['company'];
$email = $_POST['email'];
$user_type = $_POST['user_type'];
$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : null;

$sql = "UPDATE users_acc SET firstname = ?, lastname = ?, department = ?, company = ?, email = ?, user_type = ?, studentID = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssssi', $firstname, $lastname, $department, $company, $email, $user_type, $studentID, $id);

if ($stmt->execute()) {
    echo 'User updated successfully';
} else {
    echo 'Failed to update user';
}
?>