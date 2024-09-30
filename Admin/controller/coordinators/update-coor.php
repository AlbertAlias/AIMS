<?php
require_once '../../../dbconn.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Set error reporting and logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];

    // Retrieve form data
    $last_name = $_POST['coor_last_name'];
    $first_name = $_POST['coor_first_name'];
    $middle_name = $_POST['coor_middle_name'];
    $suffix = $_POST['coor_suffix'];
    $gender = $_POST['coor_gender'];
    $address = $_POST['coor_address'];
    $birthdate = $_POST['coor_birthdate'];
    $civil_status = $_POST['coor_civil_status'];
    $contact_number = $_POST['coor_contact_number'];
    $personal_email = $_POST['coor_personal_email'];
    $account_email = $_POST['coor_account_email'];
    $password = $_POST['coor_password']; // This may be optional
    $department_id = (int)$_POST['coor_department']; // Coordinator's department

    // Hash the password if provided
    $hashed_password = empty($password) ? null : password_hash($password, PASSWORD_BCRYPT);

    // Start a transaction to update both `users` and `coordinators` tables
    $conn->begin_transaction();

    try {
        // Update the user details
        $user_sql = "UPDATE users SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, gender = ?, 
                     address = ?, birthdate = ?, civil_status = ?, contact_number = ?, personal_email = ?, 
                     account_email = ?";

        // Append password update only if provided
        if ($hashed_password !== null) {
            $user_sql .= ", password = ?";
        }
        $user_sql .= " WHERE id = ?";

        $stmt = $conn->prepare($user_sql);
        if ($hashed_password !== null) {
            $stmt->bind_param("ssssssssssssi", $last_name, $first_name, $middle_name, $suffix, $gender, 
                              $address, $birthdate, $civil_status, $contact_number, $personal_email, 
                              $account_email, $hashed_password, $id);
        } else {
            $stmt->bind_param("sssssssssssi", $last_name, $first_name, $middle_name, $suffix, $gender, 
                              $address, $birthdate, $civil_status, $contact_number, $personal_email, 
                              $account_email, $id);
        }
        $stmt->execute();

        // Update the coordinator-specific details
        $coor_sql = "UPDATE coordinators SET department_id = ? WHERE user_id = ?";
        $coor_stmt = $conn->prepare($coor_sql);
        $coor_stmt->bind_param("ii", $department_id, $id);
        $coor_stmt->execute();

        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Coordinator updated successfully!';

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = 'Error updating coordinator: ' . $e->getMessage();
    }

    $stmt->close();
    $coor_stmt->close();
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit;
?>