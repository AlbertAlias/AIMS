<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $middleName = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $suffix = isset($_POST['suffix']) ? $_POST['suffix'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $civilStatus = isset($_POST['civil_status']) ? $_POST['civil_status'] : null;
    $personalEmail = isset($_POST['personal_email']) ? $_POST['personal_email'] : null;
    $contactNumber = isset($_POST['contact_number']) ? $_POST['contact_number'] : null;
    $accountEmail = isset($_POST['account_email']) ? $_POST['account_email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $role = isset($_POST['role']) ? $_POST['role'] : null;

    if (empty($lastName) || empty($firstName) || empty($gender) || empty($address) || empty($birthdate) ||
        empty($civilStatus) || empty($personalEmail) || empty($contactNumber) || empty($accountEmail) ||
        empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO admins (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, account_email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    $stmt->bind_param('sssssssssssss', $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, $accountEmail, $hashedPassword, $role);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Admin added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>