<?php
include '../../../dbconn.php';
header('Content-Type: application/json');

$data = $_POST;

$response = [];

// Required fields for validation
$requiredFields = [
    'id', 'intern_last_name', 'intern_first_name', 'intern_gender', 
    'intern_address', 'intern_birthdate', 'intern_civil_status', 
    'intern_personal_email', 'intern_contact_number', 'studentID', 
    'hours_needed', 'internship_status'
];

// Check if required fields are filled
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        $response['success'] = false;
        $response['message'] = "Field '$field' is required.";
        echo json_encode($response);
        exit;
    }
}

// Extract values from the POST data, checking if keys exist
$userID = $data['id'];
$internLastName = $data['intern_last_name'];
$internFirstName = $data['intern_first_name'];
$internMiddleName = $data['intern_middle_name'] ?? null; // Use null if not set
$internSuffix = $data['intern_suffix'] ?? null; // Use null if not set
$internGender = $data['intern_gender'];
$internAddress = $data['intern_address'];
$internBirthdate = $data['intern_birthdate'];
$internCivilStatus = $data['intern_civil_status'];
$internPersonalEmail = $data['intern_personal_email'];
$internContactNumber = $data['intern_contact_number'];
$studentID = $data['studentID'];
$coordinatorName = $data['coordinator_name'] ?? null; // Optional
$coordinatorEmail = $data['coordinator_email'] ?? null; // Optional
$hoursNeeded = $data['hours_needed'];
$internshipStatus = $data['internship_status'];
$accountEmail = $data['intern_account_email'] ?? null; // Optional
$password = !empty($data['intern_password']) ? password_hash($data['intern_password'], PASSWORD_BCRYPT) : null; // Use bcrypt for hashing

// Start transaction
$conn->begin_transaction();

try {
    // Update users table
    $stmt = $conn->prepare("UPDATE users SET 
        last_name = ?, 
        first_name = ?, 
        middle_name = ?, 
        suffix = ?, 
        gender = ?, 
        address = ?, 
        birthdate = ?, 
        civil_status = ?, 
        personal_email = ?, 
        contact_number = ?, 
        account_email = ?, 
        password = ? 
        WHERE id = ?");

    $stmt->bind_param("ssssssssssssi", 
        $internLastName, $internFirstName, $internMiddleName, 
        $internSuffix, $internGender, $internAddress, $internBirthdate, 
        $internCivilStatus, $internPersonalEmail, $internContactNumber, 
        $accountEmail, $password, $userID);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to update user.");
    }

    // Update interns table
    $stmt = $conn->prepare("UPDATE interns SET 
        studentID = ?, 
        internship_status = ?, 
        coordinator_name = ?, 
        coordinator_email = ?, 
        hours_needed = ? 
        WHERE user_id = ?");
    
    // Adjust binding based on optional values
    $stmt->bind_param("sssssi", 
        $studentID, 
        $internshipStatus, 
        $coordinatorName, 
        $coordinatorEmail, 
        $hoursNeeded, 
        $userID);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to update intern.");
    }

    // Commit transaction
    $conn->commit();

    // Success response
    $response['success'] = true;
    $response['message'] = 'Intern updated successfully!';
} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    
    // Error response
    $response['success'] = false;
    $response['message'] = 'Error occurred: ' . $e->getMessage();
}

// Close the statement and connection
$stmt->close();
$conn->close();

echo json_encode($response);