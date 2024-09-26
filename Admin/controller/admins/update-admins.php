<?php
// Include database connection
require_once '../../../dbconn.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Initialize response array
$response = ['success' => false, 'message' => ''];

// Log errors and suppress direct output
error_log('Starting admin update process...');

// Check if the required POST data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log POST data for debugging
    error_log(print_r($_POST, true)); // Log the POST data

    if (!isset($_POST['id']) || empty($_POST['admin_account_email'])) {
        $response['message'] = 'Required fields are missing.';
        echo json_encode($response);
        exit;
    }

    // Retrieve data from POST request
    $id = (int)$_POST['id'];
    $account_email = $_POST['admin_account_email'];
    $password = $_POST['admin_password'];

    // Check if the admin exists
    $checkSql = "SELECT * FROM admins WHERE id = ?";
    if ($checkStmt = $conn->prepare($checkSql)) {
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $response['message'] = 'No admin found with that ID.';
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
    $last_name = $_POST['admin_last_name'];
    $first_name = $_POST['admin_first_name'];
    $middle_name = $_POST['admin_middle_name'];
    $suffix = $_POST['admin_suffix'];
    $gender = $_POST['admin_gender'];
    $address = $_POST['admin_address'];
    $birthdate = $_POST['admin_birthdate'];
    $civil_status = $_POST['admin_civil_status'];
    $personal_email = $_POST['admin_personal_email'];
    $contact_number = $_POST['admin_contact_number'];
    $role = $_POST['role'];

    // Hash the password using bcrypt if it's not empty
    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query for updating admin information
    $sql = "UPDATE admins SET 
                last_name = ?, first_name = ?, middle_name = ?, suffix = ?, gender = ?, address = ?, birthdate = ?, 
                civil_status = ?, personal_email = ?, contact_number = ?, account_email = ?, password = ?, role = ? 
            WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssssssssssssi", 
            $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate,
            $civil_status, $personal_email, $contact_number, $account_email, $hashed_password, $role, $id
        );

        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Admin updated successfully!';
            } else {
                $response['message'] = 'No changes made to the admin.';
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

// Output the response as JSON
echo json_encode($response);
?>
