<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data with default values if not set
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
    $department = isset($_POST['department']) ? $_POST['department'] : null;
    $accountEmail = isset($_POST['account_email']) ? $_POST['account_email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Validate inputs (basic validation for example purposes)
    if (empty($lastName) || empty($firstName) || empty($gender) || empty($address) || empty($birthdate) || empty($civilStatus) || empty($personalEmail) || empty($contactNumber) || empty($department) || empty($accountEmail) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare an SQL statement to insert the coordinator data
    $stmt = $conn->prepare("INSERT INTO coordinators (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, department, account_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param('sssssssssssss', $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, $department, $accountEmail, $hashedPassword);

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Coordinator added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement.']);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>