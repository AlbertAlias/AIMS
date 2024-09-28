<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

header('Content-Type: application/json'); // Set header for JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate fields
    if (empty($data['last_name']) || empty($data['first_name']) || empty($data['gender']) ||
        empty($data['address']) || empty($data['birthdate']) || empty($data['civil_status']) ||
        empty($data['contact_number']) || empty($data['personal_email']) ||
        empty($data['account_email']) || empty($data['password']) || empty($data['role'])) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Check for duplicate account email
    $stmt = $conn->prepare("SELECT * FROM admins WHERE account_email = ?");
    $stmt->bind_param("s", $data['account_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Admin with this email already exists.']);
        exit;
    }
    $stmt->close();

    $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO admins (last_name, first_name, middle_name, suffix, gender,
    address, birthdate, civil_status, contact_number, personal_email, account_email, password, role)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if statement preparation failed
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param(
        'sssssssssssss', $data['last_name'], $data['first_name'], $data['middle_name'],
        $data['suffix'], $data['gender'], $data['address'], $data['birthdate'], $data['civil_status'],
        $data['contact_number'], $data['personal_email'], $data['account_email'], $hashedPassword,
        $data['role'],);

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