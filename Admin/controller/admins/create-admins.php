<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $last_name = isset($_POST['admin_last_name']) ? $_POST['admin_last_name'] : null;
    $first_name = isset($_POST['admin_first_name']) ? $_POST['admin_first_name'] : null;
    $middle_name = isset($_POST['admin_middle_name']) ? $_POST['admin_middle_name'] : null;
    $suffix = isset($_POST['admin_suffix']) ? $_POST['admin_suffix'] : null;
    $gender = isset($_POST['admin_gender']) ? $_POST['admin_gender'] : null;
    $address = isset($_POST['admin_address']) ? $_POST['admin_address'] : null;
    $birthdate = isset($_POST['admin_birthdate']) ? $_POST['admin_birthdate'] : null;
    $civil_status = isset($_POST['admin_civil_status']) ? $_POST['admin_civil_status'] : null;
    $personal_email = isset($_POST['admin_personal_email']) ? $_POST['admin_personal_email'] : null;
    $contact_number = isset($_POST['admin_contact_number']) ? $_POST['admin_contact_number'] : null;
    $account_email = isset($_POST['admin_account_email']) ? $_POST['admin_account_email'] : null;
    $password = isset($_POST['admin_password']) ? $_POST['admin_password'] : null;
    $role = isset($_POST['role']) ? $_POST['role'] : null;

    // Validate required fields
    if (empty($last_name) || empty($first_name) || empty($gender) || empty($address) ||
        empty($birthdate) || empty($civil_status) || empty($personal_email) ||
        empty($contact_number) || empty($account_email) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'message' => 'All fields except suffix are required.']);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO admins (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, account_email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sssssssssssss", $last_name, $first_name, $middle_name, $suffix, $gender, $address, $birthdate, $civil_status, $personal_email, $contact_number, $account_email, $password, $role);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Admin added successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding admin.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>