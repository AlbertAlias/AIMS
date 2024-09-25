<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data with default values if not set
    $last_name = $_POST['intern_last_name'] ?? null;
    $first_name = $_POST['intern_first_name'] ?? null;
    $middle_name = $_POST['intern_middle_name'] ?? null;
    $suffix = $_POST['intern_suffix'] ?? null;
    $gender = $_POST['intern_gender'] ?? null;
    $address = $_POST['intern_address'] ?? null;
    $birthdate = $_POST['intern_birthdate'] ?? null; // Assuming YYYY-MM-DD from the form
    $civil_status = $_POST['intern_civil_status'] ?? null;
    $personal_email = $_POST['intern_personal_email'] ?? null;
    $contact_number = $_POST['intern_contact_number'] ?? null;
    $studentID = $_POST['studentID'] ?? null;
    $department = $_POST['intern_department'] ?? null;
    $coordinator_name = $_POST['coordinator_name'] ?? null;
    $hours_needed = $_POST['hours_needed'] ?? null;
    $coordinator_email = $_POST['coordinator_email'] ?? null;
    $internship_status = $_POST['internship_status'] ?? null;
    $account_email = $_POST['intern_account_email'] ?? null;
    $password = $_POST['intern_password'] ?? null;

    // Validate required fields
    if (empty($last_name) || empty($first_name) || empty($gender) || empty($address) || empty($birthdate) ||
        empty($civil_status) || empty($personal_email) || empty($contact_number) || empty($studentID) ||
        empty($department) || empty($coordinator_name) || empty($hours_needed) || empty($coordinator_email) ||
        empty($internship_status) || empty($account_email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields except suffix are required.']);
        exit;
    }

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if the intern already exists based on email or student ID
    $checkStmt = $conn->prepare("SELECT id FROM interns WHERE personal_email = ? OR studentID = ?");
    $checkStmt->bind_param("ss", $personal_email, $studentID);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Intern already exists.']);
        $checkStmt->close();
        $conn->close();
        exit;
    }

    $checkStmt->close();

    // Prepare the SQL insert statement
    $stmt = $conn->prepare("INSERT INTO interns (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, studentID, department, coordinator_name, hours_needed, coordinator_email, internship_status, account_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssssssssssssss", $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, $contact_number, $studentID, $department, $coordinator_name, $hours_needed, $coordinator_email, $internship_status, $account_email, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Intern added successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding intern.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>