<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

// Check if data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data and sanitize input to prevent SQL injection
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $civilStatus = mysqli_real_escape_string($conn, $_POST['civil_status']);
    $personalEmail = mysqli_real_escape_string($conn, $_POST['personal_email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $accountEmail = mysqli_real_escape_string($conn, $_POST['account_email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Remove leading '0' if present
    if (substr($contactNumber, 0, 1) === '0') {
        $contactNumber = substr($contactNumber, 1);
    }

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert coordinator data into the database
    $query = "INSERT INTO coordinators (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, department, account_email, password)
              VALUES ('$lastName', '$firstName', '$middleName', '$suffix', '$gender', '$address', '$birthdate', '$civilStatus', '$personalEmail', '$contactNumber', '$department', '$accountEmail', '$hashedPassword')";

    if (mysqli_query($conn, $query)) {
        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return failure response with detailed error message
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }

    // Close connection
    mysqli_close($conn);
}
?>