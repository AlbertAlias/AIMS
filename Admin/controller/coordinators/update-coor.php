<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json'); // Set response type to JSON

    // Sanitize and collect form data
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
    
    // Prepare password query part if password is provided
    $passwordQuery = "";
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $passwordQuery = "password = '$password'";
    }

    // Remove leading '0' from contact number
    if (substr($contactNumber, 0, 1) === '0') {
        $contactNumber = substr($contactNumber, 1);
    }

    // Construct SQL update query
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
                  account_email = '$accountEmail'"
              . ($passwordQuery ? ", $passwordQuery" : "") . " 
              WHERE id = '$id'";

    // Execute query and return JSON response
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }

    // Close database connection
    mysqli_close($conn);
}
?>