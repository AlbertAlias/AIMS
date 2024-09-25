<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted JSON data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Extract data
    $adminLastName = $data['admin_last_name'];
    $adminFirstName = $data['admin_first_name'];
    $adminMiddleName = isset($data['admin_middle_name']) ? $data['admin_middle_name'] : null;
    $adminSuffix = isset($data['admin_suffix']) ? $data['admin_suffix'] : null;
    $adminGender = $data['admin_gender'];
    $adminAddress = $data['admin_address'];
    $adminBirthdate = $data['admin_birthdate'];
    $adminCivilStatus = $data['admin_civil_status'];
    $adminContactNumber = $data['admin_contact_number'];
    $adminPersonalEmail = $data['admin_personal_email'];
    $adminAccountEmail = $data['admin_account_email'];
    $adminPassword = password_hash($data['admin_password'], PASSWORD_BCRYPT); // Hash the password
    $role = $data['role'];

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
        echo json_encode(['success' => false, 'message' => 'Error adding admin: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>