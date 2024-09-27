<?php
require_once '../../../dbconn.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_log('Starting coordinator update process...');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    
    error_log("Checking for coordinator ID: $id");

    $checkSql = "SELECT * FROM coordinators WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No coordinator found with that ID.';
            echo json_encode($response);
            exit;
        }
        $checkStmt->close();
    } else {
        $response['message'] = 'Error preparing check statement: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $last_name = $_POST['coor_last_name'];
    $first_name = $_POST['coor_first_name'];
    $middle_name = $_POST['coor_middle_name'];
    $suffix = $_POST['coor_suffix'];
    $gender = $_POST['coor_gender'];
    $address = $_POST['coor_address'];
    $birthdate = $_POST['coor_birthdate'];
    $civil_status = $_POST['coor_civil_status'];
    $personal_email = $_POST['coor_personal_email'];
    $contact_number = $_POST['coor_contact_number'];
    $department = $_POST['coor_department'];
    $account_email = $_POST['coor_account_email'];
    $password = $_POST['coor_password'];

    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE coordinators SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, gender = ?, 
                address = ?, birthdate = ?, civil_status = ?, personal_email = ?, contact_number = ?, 
                department = ?, account_email = ?, password = ? 
            WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssssssi", $last_name, $first_name, $middle_name, 
            $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, $contact_number, 
            $department, $account_email, $hashed_password, $id
        );

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Coordinator updated successfully!';
            } else {
                $response['message'] = 'No changes made to the coordinator.';
            }
        } else {
            $response['message'] = 'Error executing update: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit;
?>