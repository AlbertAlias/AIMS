<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data with default values if not set
    $lastName = $_POST['last_name'] ?? null;
    $firstName = $_POST['first_name'] ?? null;
    $middleName = $_POST['middle_name'] ?? null;
    $suffix = $_POST['suffix'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $address = $_POST['address'] ?? null;
    $birthdate = $_POST['birthdate'] ?? null;
    $civilStatus = $_POST['civil_status'] ?? null;
    $personalEmail = $_POST['personal_email'] ?? null;
    $contactNumber = $_POST['contact_number'] ?? null;
    $department = $_POST['department'] ?? null;
    $coordinatorName = $_POST['coordinator_name'] ?? null;
    $hoursNeeded = $_POST['hours_needed'] ?? null;
    $coordinatorEmail = $_POST['coordinator_email'] ?? null;
    $internshipStatus = $_POST['internship_status'] ?? null;
    $accountEmail = $_POST['account_email'] ?? null;
    $password = $_POST['password'] ?? null;

    // Validate required fields
    if (
        empty($lastName) || empty($firstName) || empty($gender) || 
        empty($address) || empty($birthdate) || empty($civilStatus) || 
        empty($personalEmail) || empty($contactNumber) || empty($department) || 
        empty($coordinatorName) || empty($hoursNeeded) || empty($coordinatorEmail) || 
        empty($internshipStatus) || empty($accountEmail) || empty($password)
    ) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement to insert the intern data
    $stmt = $conn->prepare("INSERT INTO interns 
        (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, department, coordinator_name, hours_needed, coordinator_email, internship_status, account_email, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param('sssssssssssssssss', 
        $lastName, $firstName, $middleName, $suffix, $gender, 
        $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, 
        $department, $coordinatorName, $hoursNeeded, $coordinatorEmail, 
        $internshipStatus, $accountEmail, $hashedPassword
    );

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Intern added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>