<?php
    require_once '../../../dbconn.php';
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => ''];

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    error_log('Starting admin update process...');
    
    // Check for any PHP errors before the header is sent
    if (ob_get_length()) {
        ob_end_clean();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)$_POST['id'];
        error_log("Checking for admin ID: $id");

        // Check for admin existence
        $checkSql = "SELECT * FROM admins WHERE user_id = ?";
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

        // Collect data
        $last_name = $_POST['admin_last_name'];
        $first_name = $_POST['admin_first_name'];
        $middle_name = $_POST['admin_middle_name'];
        $suffix = $_POST['admin_suffix'];
        $gender = $_POST['admin_gender'];
        $address = $_POST['admin_address'];
        $birthdate = $_POST['admin_birthdate'];
        $civil_status = $_POST['admin_civil_status'];
        $contact_number = $_POST['admin_contact_number'];
        $personal_email = $_POST['admin_personal_email'];
        $user_type = $_POST['user_type'];

        // Update the admin details without account email and password
        $sql = "UPDATE users SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, 
                gender = ?, address = ?, birthdate = ?, civil_status = ?, contact_number = ?,
                personal_email = ?, user_type = ? WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        // Bind parameters
        $stmt->bind_param("sssssssssssi", $last_name, $first_name, $middle_name, 
            $suffix, $gender, $address, $birthdate, $civil_status, $contact_number, $personal_email, 
            $user_type, $id);

        // Execute the statement
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Admin updated successfully!';
        } else {
            $response['message'] = 'Error executing update: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
?>