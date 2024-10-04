<?php
include '../../../dbconn.php';
header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $internID = $_POST['id'] ?? ''; // Make sure it's set
    $lastName = $_POST['intern_last_name'] ?? '';
    $firstName = $_POST['intern_first_name'] ?? '';
    $middleName = $_POST['intern_middle_name'] ?? '';
    $suffix = $_POST['intern_suffix'] ?? '';
    $gender = $_POST['intern_gender'] ?? '';
    $address = $_POST['intern_address'] ?? '';
    $birthdate = $_POST['intern_birthdate'] ?? '';
    $civilStatus = $_POST['intern_civil_status'] ?? '';
    $personalEmail = $_POST['intern_personal_email'] ?? '';
    $contactNumber = $_POST['intern_contact_number'] ?? '';
    $studentID = $_POST['studentID'] ?? '';
    $departmentID = $_POST['intern_department'] ?? '';
    $coordinatorName = $_POST['coordinator_name'] ?? ''; // Default to empty string if not set
    $coordinatorEmail = $_POST['coordinator_email'] ?? ''; // Default to empty string if not set
    $hoursNeeded = $_POST['hours_needed'] ?? '';
    $internshipStatus = $_POST['internship_status'] ?? '';
    $accountEmail = $_POST['intern_account_email'] ?? ''; // Default to empty string if not set
    $password = $_POST['intern_password'] ?? ''; // Default to empty string if not set

    // Prepare and bind
    $stmt = $conn->prepare
            ("UPDATE users 
                    SET last_name=?, first_name=?, middle_name=?, suffix=?, gender=?, address=?, birthdate=?,
                        civil_status=?, personal_email=?, contact_number=?, account_email=?, password=?, department_id=? 
                    WHERE id=(SELECT user_id FROM interns WHERE id=?)");
    
    $stmt->bind_param("sssssssssssssi", 
        $lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate,
        $civilStatus, $personalEmail, $contactNumber, $accountEmail, $password, $departmentID,
        $internID);

    if ($stmt->execute()) {
        $stmt = $conn->prepare
                ("UPDATE interns 
                        SET studentID=?, internship_status=?, coordinator_name=?, coordinator_email=?, hours_needed=? 
                        WHERE id=?");
        
        $stmt->bind_param("sssssi", 
            $studentID, $internshipStatus, $coordinatorName, $coordinatorEmail, $hoursNeeded, $internID);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Intern updated successfully!';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to update intern information!';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Failed to update user information!';
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method!';
}

echo json_encode($response);
$conn->close();
?>