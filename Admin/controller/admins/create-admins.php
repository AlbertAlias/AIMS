<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../dbconn.php';

function validateInput($data) {
    // Validate required fields
    $requiredFields = ['admin_last_name', 'admin_first_name', 'admin_gender', 'admin_address', 'admin_birthdate', 'admin_civil_status', 'admin_personal_email', 'admin_account_email', 'admin_password', 'role'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            return false;
        }
    }
    // Additional validations can be added here
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted JSON data
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!validateInput($data)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Extract and sanitize data
    $adminLastName = trim($data['admin_last_name']);
    $adminFirstName = trim($data['admin_first_name']);
    $adminMiddleName = isset($data['admin_middle_name']) ? trim($data['admin_middle_name']) : null;
    $adminSuffix = isset($data['admin_suffix']) ? trim($data['admin_suffix']) : null;
    $adminGender = trim($data['admin_gender']);
    $adminAddress = trim($data['admin_address']);
    $adminBirthdate = trim($data['admin_birthdate']);
    $adminCivilStatus = trim($data['admin_civil_status']);
    $adminContactNumber = trim($data['admin_contact_number']);
    $adminPersonalEmail = trim($data['admin_personal_email']);
    $adminAccountEmail = trim($data['admin_account_email']);
    $adminPassword = password_hash(trim($data['admin_password']), PASSWORD_BCRYPT); // Hash the password
    $role = trim($data['role']);

    // Check for existing personal_email
    $checkEmailStmt = $conn->prepare("SELECT COUNT(*) FROM admins WHERE personal_email = ?");
    $checkEmailStmt->bind_param("s", $adminPersonalEmail);
    $checkEmailStmt->execute();
    $checkEmailStmt->bind_result($emailCount);
    $checkEmailStmt->fetch();
    $checkEmailStmt->close();

    if ($emailCount > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists.']);
        exit; // Stop further execution
    }

    // Prepare and bind your SQL statement
    $stmt = $conn->prepare("INSERT INTO admins (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, contact_number, personal_email, account_email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $adminLastName, $adminFirstName, $adminMiddleName, $adminSuffix, $adminGender, $adminAddress, $adminBirthdate, $adminCivilStatus, $adminContactNumber, $adminPersonalEmail, $adminAccountEmail, $adminPassword, $role);

    // Execute and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        // Log error for internal review
        error_log('SQL Error: ' . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Error adding admin. Please try again.']);
    }

    // Clean up
    $stmt->close();
    $conn->close();
}
?>