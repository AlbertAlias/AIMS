<?php
header('Content-Type: application/json');
include '../../../dbconn.php'; // Include your database connection file

$data = json_decode(file_get_contents('php://input'), true);

$last_name = $data['last_name'];
$first_name = $data['first_name'];
$middle_name = $data['middle_name'] ?? '';
$suffix = $data['suffix'] ?? '';
$gender = $data['gender'] ?? '';
$address = $data['address'] ?? '';
$birthdate = $data['birthdate'] ?? '';
$civil_status = $data['civil_status'] ?? '';
$personal_email = $data['personal_email'] ?? '';
$contact_number = $data['contact_number'] ?? '';
$department = $data['department'] ?? '';

if (empty($last_name) || empty($first_name) || empty($gender) || empty($address) || empty($birthdate) || empty($civil_status) || empty($personal_email) || empty($department)) {
    echo json_encode(['success' => false, 'message' => 'Required fields are missing.']);
    exit;
}

if (!filter_var($personal_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

$password_hash = password_hash($data['password'] ?? 'default_password', PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO coordinators (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, department, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, $contact_number, $department, $password);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Coordinator created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error creating coordinator: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
