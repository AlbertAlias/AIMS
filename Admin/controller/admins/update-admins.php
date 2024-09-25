<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../dbconn.php'; // Include your MySQLi database connection

// Return the response as JSON
header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use the null coalescing operator to avoid undefined array keys
    $id = $_POST['id'] ?? null;
    $last_name = $_POST['admin_last_name'] ?? null;
    $first_name = $_POST['admin_first_name'] ?? null;
    $middle_name = $_POST['admin_middle_name'] ?? null;
    $suffix = $_POST['admin_suffix'] ?? null;
    $gender = $_POST['admin_gender'] ?? null;
    $address = $_POST['admin_address'] ?? null;
    $birthdate = $_POST['admin_birthdate'] ?? null;
    $civil_status = $_POST['admin_civil_status'] ?? null;
    $contact_number = $_POST['admin_contact_number'] ?? null;
    $personal_email = $_POST['admin_personal_email'] ?? null;
    $account_email = $_POST['admin_account_email'] ?? null;
    $password = !empty($_POST['admin_password']) ? password_hash($_POST['admin_password'], PASSWORD_BCRYPT) : null; // Hash password if provided
    $role = $_POST['role'] ?? null;

    // Validate required fields
    if (!$id || !$last_name || !$first_name || !$gender || !$address || !$birthdate || !$civil_status || !$contact_number || !$personal_email || !$account_email || !$password || !$role) {
        $response['success'] = false;
        $response['error'] = 'Missing required fields.';
        echo json_encode($response);
        exit;
    }

    // Check if the MySQLi connection is defined and properly set up
    if (isset($conn)) {
        // Prepare the SQL statement
        $sql = "UPDATE admins SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, gender = ?, address = ?, birthdate = ?, civil_status = ?, contact_number = ?, personal_email = ?, account_email = ?, role = ?";
        
        // Conditionally append password to the query if provided
        if ($password !== null) {
            $sql .= ", password = ?";
        }
        
        $sql .= " WHERE id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Conditionally bind parameters based on whether the password is provided
            if ($password !== null) {
                $stmt->bind_param(
                    "ssssssssssssi", 
                    $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, 
                    $contact_number, $personal_email, $account_email, $role, $password, $id
                );
            } else {
                $stmt->bind_param(
                    "ssssssssssss", 
                    $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, 
                    $contact_number, $personal_email, $account_email, $role, $id
                );
            }

            // Execute the statement
            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['error'] = 'Failed to update admin details: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['error'] = 'Failed to prepare the statement: ' . $conn->error;
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Database connection error.';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Invalid request method.';
}

echo json_encode($response);
?>