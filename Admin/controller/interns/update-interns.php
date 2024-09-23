<?php
// Include database connection
require_once '../../../dbconn.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'message' => ''];

// Log errors and suppress direct output
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_log('Starting intern update process...');

// Check if the required POST data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $id = (int)$_POST['id'];
    $birthdate = $_POST['birthdate'];

    // Ensure the date is valid (in case it's empty or invalid)
    if (!$birthdate || $birthdate == '0000-00-00') {
        $response['message'] = 'Invalid birthdate provided.';
        echo json_encode($response);
        exit;
    }

    // Check if the intern exists
    $checkSql = "SELECT * FROM interns WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No intern found with that ID.';
            echo json_encode($response);
            exit;
        }
        $checkStmt->close();
    } else {
        $response['message'] = 'Error preparing check statement: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    // Retrieve other fields
    $last_name = $_POST['intern_last_name'];
    $first_name = $_POST['intern_first_name'];
    $middle_name = $_POST['intern_middle_name'];
    $suffix = $_POST['intern_suffix'];
    $gender = $_POST['intern_gender'];
    $address = $_POST['intern_address'];
    $civil_status = $_POST['intern_civil_status'];
    $personal_email = $_POST['intern_personal_email'];
    $contact_number = $_POST['intern_contact_number'];
    $studentID = $_POST['studentID'];
    $department = $_POST['intern_department'];
    $coordinator_name = $_POST['coordinator_name'];
    $hours_needed = $_POST['hours_needed'];
    $coordinator_email = $_POST['coordinator_email'];
    $internship_status = $_POST['internship_status'];
    $account_email = $_POST['intern_account_email'];
    $password = $_POST['intern_password'];

    // Hash the password using bcrypt if it's not empty
    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query for updating intern information
    $sql = "UPDATE interns SET 
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
                studentID = ?, 
                department = ?, 
                coordinator_name = ?, 
                hours_needed = ?, 
                coordinator_email = ?, 
                internship_status = ?, 
                account_email = ?, 
                password = ? 
            WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssssssssssssssssi", 
            $last_name, 
            $first_name, 
            $middle_name, 
            $suffix, 
            $gender, 
            $address, 
            $birthdate, 
            $civil_status, 
            $personal_email, 
            $contact_number, 
            $studentID, 
            $department, 
            $coordinator_name, 
            $hours_needed, 
            $coordinator_email, 
            $internship_status, 
            $account_email, 
            $hashed_password, 
            $id
        );

        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Intern updated successfully!';
            } else {
                $response['message'] = 'No changes made to the intern.';
            }
        } else {
            $response['message'] = 'Error executing update: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit;
?>