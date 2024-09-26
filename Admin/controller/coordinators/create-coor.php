<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $lastName = isset($_POST['coor_last_name']) ? $_POST['coor_last_name'] : null;
    $firstName = isset($_POST['coor_first_name']) ? $_POST['coor_first_name'] : null;
    $middleName = isset($_POST['coor_middle_name']) ? $_POST['coor_middle_name'] : null;
    $suffix = isset($_POST['coor_suffix']) ? $_POST['coor_suffix'] : null;
    $gender = isset($_POST['coor_gender']) ? $_POST['coor_gender'] : null;
    $address = isset($_POST['coor_address']) ? $_POST['coor_address'] : null;
    $birthdate = isset($_POST['coor_birthdate']) ? $_POST['coor_birthdate'] : null;
    $civilStatus = isset($_POST['coor_civil_status']) ? $_POST['coor_civil_status'] : null;
    $personalEmail = isset($_POST['coor_personal_email']) ? $_POST['coor_personal_email'] : null;
    $contactNumber = isset($_POST['coor_contact_number']) ? $_POST['coor_contact_number'] : null;
    $department = isset($_POST['coor_department']) ? $_POST['coor_department'] : null;
    $accountEmail = isset($_POST['coor_account_email']) ? $_POST['coor_account_email'] : null;
    $password = isset($_POST['coor_password']) ? $_POST['coor_password'] : null;

    if (empty($lastName) || empty($firstName) || empty($gender) || empty($address) || empty($birthdate) || empty($civilStatus) || empty($personalEmail) || empty($contactNumber) || empty($department) || empty($accountEmail) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO coordinators (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, department, account_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    $stmt->bind_param('sssssssssssss', $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, $department, $accountEmail, $hashedPassword);

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