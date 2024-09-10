<?php
include '../../../dbconn.php';

try {
    $id = $_POST['editUserId'];
    $firstname = $_POST['editFirstName'];
    $lastname = $_POST['editLastName'];
    $department = $_POST['editDepartment'];
    $studentID = $_POST['editStudentID'];
    $company = $_POST['editCompany'];
    $email = $_POST['editEmail'];
    $password = $_POST['editPassword'];
    $user_type = $_POST['editUserType'];

    // Hash the password if it's not empty
    $hashedPassword = empty($password) ? null : password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users_acc SET firstname = ?, lastname = ?, department = ?, studentID = ?, company = ?, email = ?, password = ?, user_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $firstname, $lastname, $department, $studentID, $company, $email, $hashedPassword, $user_type, $id);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$stmt->close();
$conn->close();
?>
