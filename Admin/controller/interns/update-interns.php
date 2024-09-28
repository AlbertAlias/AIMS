<?php
require_once '../../../dbconn.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

ini_set('display_errors', 1);
error_reporting(E_ALL);
error_log('Starting intern update process...');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $birthdate = $_POST['intern_birthdate'];

    // Validate birthdate
    if (empty($birthdate) || $birthdate === '0000-00-00' || !DateTime::createFromFormat('Y-m-d', $birthdate)) {
        $response['message'] = 'Invalid birthdate provided.';
        echo json_encode($response);
        exit;
    }

    error_log("Checking for intern ID: $id");
    // Check for intern existence
    $checkSql = "SELECT * FROM interns WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No intern found with that ID.';
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
    $last_name = $_POST['intern_last_name'];
    $first_name = $_POST['intern_first_name'];
    $middle_name = $_POST['intern_middle_name'];
    $suffix = $_POST['intern_suffix'];
    $gender = $_POST['intern_gender'];
    $address = $_POST['intern_address'];
    $civil_status = $_POST['intern_civil_status'];
    $personal_email = $_POST['intern_personal_email'];
    $contact_number = $_POST['intern_contact_number'];
    $studentID = $_POST['studentID'];
    $department = $_POST['intern_department'];
    $coordinator_name = $_POST['coordinator_name'];
    $hours_needed = $_POST['hours_needed'];
    $coordinator_email = $_POST['coordinator_email'];
    $internship_status = $_POST['internship_status'];
    $account_email = $_POST['intern_account_email'];
    $password = $_POST['intern_password'];

    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    // Updated SQL query with proper placeholders
    $sql = "UPDATE interns SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, 
            gender = ?, address = ?, birthdate = ?, civil_status = ?, personal_email = ?, 
            contact_number = ?, studentID = ?, department = ?, coordinator_name = ?, 
            hours_needed = ?, coordinator_email = ?, internship_status = ?, 
            account_email = ?, password = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters including hashed password
        $stmt->bind_param("ssssssssssssssssssi", $last_name, $first_name, $middle_name, 
            $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, 
            $contact_number, $studentID, $department, $coordinator_name, 
            $hours_needed, $coordinator_email, $internship_status, $account_email, 
            $hashed_password, $id
        );

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Intern updated successfully!';
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