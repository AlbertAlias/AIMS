<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $lastName = isset($_POST['intern_last_name']) ? $_POST['intern_last_name'] : null;
    $firstName = isset($_POST['intern_first_name']) ? $_POST['intern_first_name'] : null;
    $middleName = isset($_POST['intern_middle_name']) ? $_POST['intern_middle_name'] : null;
    $suffix = isset($_POST['intern_suffix']) ? $_POST['intern_suffix'] : null;
    $gender = isset($_POST['intern_gender']) ? $_POST['intern_gender'] : null;
    $address = isset($_POST['intern_address']) ? $_POST['intern_address'] : null;
    $birthdate = isset($_POST['intern_birthdate']) ? $_POST['intern_birthdate'] : null;
    $civilStatus = isset($_POST['intern_civil_status']) ? $_POST['intern_civil_status'] : null;
    $personalEmail = isset($_POST['intern_personal_email']) ? $_POST['intern_personal_email'] : null;
    $contactNumber = isset($_POST['intern_contact_number']) ? $_POST['intern_contact_number'] : null;
    $studentId = isset($_POST['studenID']) ? $_POST['studentID'] : null;
    $department = isset($_POST['intern_department']) ? $_POST['intern_department'] : null;
    $coorName = isset($_POST['coordinator_name']) ? $_POST['coordinator_name'] : null;
    $hoursNeeded = isset($_POST['hours_needed']) ? $_POST['hours_needed'] : null;
    $coorEmail = isset($_POST['coordinator_email']) ? $_POST['coordinator_email'] : null;
    $internStatus = isset($_POST['internship_status']) ? $_POST['internship_status'] : null;
    $accountEmail = isset($_POST['intern_account_email']) ? $_POST['intern_account_email'] : null;
    $password = isset($_POST['intern_password']) ? $_POST['intern_password'] : null;

    if (empty($lastName) || empty($firstName) || empty($gender) || empty($address) || empty($birthdate) ||
        empty($civilStatus) || empty($personalEmail) || empty($contactNumber) || empty($studentId) ||
        empty($department) || empty($coorName) || empty($hoursNeeded) || empty($coorEmail) ||
        empty($internStatus) || empty($accountEmail) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare(
        "INSERT INTO 
        coordinators (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status,
        personal_email, contact_number, ,studentID, department, coordinator_name, hours_needed, coordinator_email,
        internship_status, account_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    $stmt->bind_param('ssssssssssssssssss', 
    $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail,
    $contactNumber, $studentId, $department, $coorName, $hoursNeeded, $coorEmail, $internStatus, $accountEmail, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Coordinator added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>