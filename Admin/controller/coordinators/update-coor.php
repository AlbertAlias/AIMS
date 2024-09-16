<?php
include '../../../dbconn.php';

// Check if data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data and sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);
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

    // If password needs to be updated, hash it, otherwise, skip hashing
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $passwordUpdate = "password = '$hashedPassword',";
    } else {
        $passwordUpdate = ""; // Don't include password update if it's empty
    }

    // Remove leading '0' if present in contact number
    if (substr($contactNumber, 0, 1) === '0') {
        $contactNumber = substr($contactNumber, 1);
    }

    // SQL query to update the coordinator's data
    $query = "UPDATE coordinators 
              SET last_name = '$lastName', 
                  first_name = '$firstName', 
                  middle_name = '$middleName', 
                  suffix = '$suffix', 
                  gender = '$gender', 
                  address = '$address', 
                  birthdate = '$birthdate', 
                  civil_status = '$civilStatus', 
                  personal_email = '$personalEmail', 
                  contact_number = '$contactNumber', 
                  department = '$department', 
                  account_email = '$accountEmail',
                  $passwordUpdate
              WHERE id = '$id'";

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