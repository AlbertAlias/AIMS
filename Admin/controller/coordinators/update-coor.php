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
    $lastName = mysqli_real_escape_string($conn, $_POST['coor_last_name']);
    $firstName = mysqli_real_escape_string($conn, $_POST['coor_first_name']);
    $middleName = mysqli_real_escape_string($conn, $_POST['coor_middle_name']);
    $suffix = mysqli_real_escape_string($conn, $_POST['coor_suffix']);
    $gender = mysqli_real_escape_string($conn, $_POST['coor_gender']);
    $address = mysqli_real_escape_string($conn, $_POST['coor_address']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['coor_birthdate']);
    $civilStatus = mysqli_real_escape_string($conn, $_POST['coor_civil_status']);
    $personalEmail = mysqli_real_escape_string($conn, $_POST['cooor_personal_email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['coor_contact_number']);
    $department = mysqli_real_escape_string($conn, $_POST['coor_department']);
    $accountEmail = mysqli_real_escape_string($conn, $_POST['coor_account_email']);
    
    // Prepare password query part if password is provided
    $passwordQuery = "";
    if (!empty($_POST['coor_password'])) {
        $password = password_hash($_POST['coor_password'], PASSWORD_BCRYPT);
        $passwordQuery = "coor_password = '$password'";
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