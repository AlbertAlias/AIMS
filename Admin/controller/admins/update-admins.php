<?php
require_once '../../../dbconn.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

ini_set('display_errors', 1);
error_reporting(E_ALL);
error_log('Starting admin update process...');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    error_log("Checking for admin ID: $id");

    // Check for admin existence
    $checkSql = "SELECT * FROM admins WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No admin found with that ID.';
            echo json_encode($response);
            exit;
        }
        $checkStmt->close();
    } else {
        $response['message'] = 'Error preparing check statement: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    // Collect data
    $last_name = $_POST['admin_last_name'];
    $first_name = $_POST['admin_first_name'];
    $middle_name = $_POST['admin_middle_name'];
    $suffix = $_POST['admin_suffix'];
    $gender = $_POST['admin_gender'];
    $address = $_POST['admin_address'];
    $birthdate = $_POST['admin_birthdate'];
    $civil_status = $_POST['admin_civil_status'];
    $contact_number = $_POST['admin_contact_number'];
    $personal_email = $_POST['admin_personal_email'];
    $account_email = $_POST['admin_account_email'];
    $password = $_POST['admin_password'];
    $user_type = $_POST['user_type']; // Update here

    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    // Updated SQL query to change role to user_type
    $sql = "UPDATE users SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, 
            gender = ?, address = ?, birthdate = ?, civil_status = ?, contact_number = ?,
            personal_email = ?, account_email = ?, password = ?, user_type = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters including hashed password
        $stmt->bind_param("sssssssssssssi", $last_name, $first_name, $middle_name, 
            $suffix, $gender, $address, $birthdate, $civil_status, $contact_number, 
            $personal_email, $account_email, $hashed_password, $user_type, $id
        );

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Admin updated successfully!';
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