<?php
// Include database connection
require_once '../../../dbconn.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'message' => ''];

// Check if the required POST data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $id = (int)$_POST['id'];  // Force ID to be an integer
    error_log("Received ID: " . $id); // Log the received ID

    // Check if intern exists
    $checkSql = "SELECT * FROM interns WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No intern found with that ID.';
            error_log("No intern found with ID: " . $id); // Log the failure
            echo json_encode($response);
            exit;
        }
        $checkStmt->close();
    } else {
        $response['message'] = 'Error preparing check statement: ' . $conn->error;
        error_log("Error preparing check statement: " . $conn->error);
        echo json_encode($response);
        exit;
    }

    // Retrieve the other fields
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $civil_status = $_POST['civil_status'];
    $personal_email = $_POST['personal_email'];
    $contact_number = $_POST['contact_number'];
    $studentID = $_POST['studentID'];
    $department = $_POST['department'];
    $coordinator_name = $_POST['coordinator_name'];
    $hours_needed = $_POST['hours_needed'];
    $coordinator_email = $_POST['coordinator_email'];
    $internship_status = $_POST['internship_status'];
    $account_email = $_POST['account_email'];
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

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
                $response['message'] = 'No changes made to the intern data.';
            }
        } else {
            $response['message'] = 'Error executing query: ' . $stmt->error;
            error_log("Error executing query: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
        error_log("Error preparing statement: " . $conn->error);
    }
}

// Close the database connection
$conn->close();

// Return JSON response
echo json_encode($response);
?>