<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data with default values if not set
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $suffix = isset($_POST['suffix']) ? $_POST['suffix'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $civil_status = isset($_POST['civil_status']) ? $_POST['civil_status'] : null;
    $personal_email = isset($_POST['personal_email']) ? $_POST['personal_email'] : null;
    $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : null;
    $studentID = isset($_POST['studentID']) ? $_POST['studentID'] : null;
    $department = isset($_POST['department']) ? $_POST['department'] : null;
    $coordinator_name = isset($_POST['coordinator_name']) ? $_POST['coordinator_name'] : null;
    $hours_needed = isset($_POST['hours_needed']) ? $_POST['hours_needed'] : null;
    $coordinator_email = isset($_POST['coordinator_email']) ? $_POST['coordinator_email'] : null;
    $internship_status = isset($_POST['internship_status']) ? $_POST['internship_status'] : null;
    $account_email = isset($_POST['account_email']) ? $_POST['account_email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Validate required fields
    if (empty($last_name) || empty($first_name) || empty($middle_name) || empty($gender) ||
        empty($address) || empty($birthdate) || empty($civil_status) || empty($personal_email) ||
        empty($contact_number) || empty($studentID) || empty($department) || empty($coordinator_name) ||
        empty($hours_needed) || empty($coordinator_email) || empty($internship_status) || empty($account_email) ||
        empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields except suffix are required.']);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO interns (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, studentID, department, coordinator_name, hours_needed, coordinator_email, internship_status, account_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssssssssssssss", $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, $contact_number, $studentID, $department, $coordinator_name, $hours_needed, $coordinator_email, $internship_status, $account_email, $password);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Intern added successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Error occurred while adding intern.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>