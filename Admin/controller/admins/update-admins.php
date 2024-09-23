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
    $checkSql = "SELECT * FROM admins WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No intern found with that ID.';
            error_log("No adminn found with ID: " . $id); // Log the failure
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
    $last_name = $_POST['admin_last_name'];
    $first_name = $_POST['admin_first_name'];
    $middle_name = $_POST['admin_middle_name'];
    $suffix = $_POST['admin_suffix'];
    $gender = $_POST['admin_gender'];
    $address = $_POST['admin-address'];
    $birthdate = $_POST['admin_birthdate'];
    $civil_status = $_POST['admin_civil_status'];
    $contact_number = $_POST['admin_contact_number'];
    $personal_email = $_POST['admin_personal_email'];
    $account_email = $_POST['admin_account_email'];
    $password = $_POST['admin_password'];
    $role = $_POST['role'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query for updating intern information
    $sql = "UPDATE admins SET 
                last_name = ?, 
                first_name = ?, 
                middle_name = ?, 
                suffix = ?, 
                gender = ?, 
                address = ?, 
                birthdate = ?, 
                civil_status = ?,
                contact_number = ?, 
                personal_email = ?, 
                account_email = ?, 
                password = ? ,
                role = ?
            WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssssssssssssi", 
            $last_name, 
            $first_name, 
            $middle_name, 
            $suffix, 
            $gender, 
            $address, 
            $birthdate, 
            $civil_status, 
            $contact_number, 
            $personal_email, 
            $account_email, 
            $hashed_password, 
            $role,
            $id
        );

        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Admin updated successfully!';
            } else {
                $response['message'] = 'No changes made to the admin data.';
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