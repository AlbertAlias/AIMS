<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include '../../../dbconn.php';

$response = array();
file_put_contents('php://stderr', print_r($_POST, true)); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $lastName = $conn->real_escape_string($_POST['intern_last_name']);
    $firstName = $conn->real_escape_string($_POST['intern_first_name']);
    $middleName = $conn->real_escape_string($_POST['intern_middle_name']);
    $suffix = $conn->real_escape_string($_POST['intern_suffix']);
    $gender = $conn->real_escape_string($_POST['intern_gender']);
    $address = $conn->real_escape_string($_POST['intern_address']);
    $birthdate = $conn->real_escape_string($_POST['intern_birthdate']);
    $civilStatus = $conn->real_escape_string($_POST['intern_civil_status']);
    $personalEmail = $conn->real_escape_string($_POST['intern_personal_email']);
    $contactNumber = $conn->real_escape_string($_POST['intern_contact_number']);
    $studentID = $conn->real_escape_string($_POST['studentID']);
    $department = $conn->real_escape_string($_POST['intern_department']);
    $accountEmail = isset($_POST['intern_account_email']) ? $conn->real_escape_string($_POST['intern_account_email']) : null;
    $password = isset($_POST['intern_password']) ? password_hash($conn->real_escape_string($_POST['intern_password']), PASSWORD_BCRYPT) : null;

    // Check for email existence
    if ($accountEmail) {
        $emailCheckStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE account_email = ?");
        $emailCheckStmt->bind_param("s", $accountEmail);
        $emailCheckStmt->execute();
        $emailCheckStmt->bind_result($count);
        $emailCheckStmt->fetch();
        $emailCheckStmt->close();

        if ($count > 0) {
            $response['success'] = false;
            $response['message'] = "The email address is already registered.";
            echo json_encode($response);
            exit; // Exit to prevent further processing
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Account email is required.";
        echo json_encode($response);
        exit;
    }

    // Begin transaction
    if ($conn->begin_transaction()) {
        $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, account_email, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'intern', ?)");
        $stmt->bind_param("ssssssssssssi", $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, $accountEmail, $password, $department);
        
        if ($stmt->execute()) {
            $userId = $stmt->insert_id;

            $stmt = $conn->prepare("INSERT INTO interns (user_id, studentID) VALUES (?, ?)");
            $stmt->bind_param("is", $userId, $studentID);
            
            if ($stmt->execute()) {
                $conn->commit();
                $response['success'] = true;
                $response['message'] = "Intern added successfully.";
            } else {
                $conn->rollback();
                $response['success'] = false;
                $response['message'] = "Error adding intern: " . $stmt->error;
            }
        } else {
            $conn->rollback();
            $response['success'] = false;
            $response['message'] = "Error adding user: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = "Transaction could not be started.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>