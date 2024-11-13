<?php
    require '../../../dbconn.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_intern') {
        $id = $_POST['id'];
        $lastName = $_POST['intern_last_name'];
        $firstName = $_POST['intern_first_name'];
        $middleName = $_POST['intern_middle_name'];
        $suffix = $_POST['intern_suffix'];
        $gender = $_POST['intern_gender'];
        $address = $_POST['intern_address'];
        $birthdate = $_POST['intern_birthdate'];
        $civilStatus = $_POST['intern_civil_status'];
        $personalEmail = $_POST['intern_personal_email'];
        $contactNumber = $_POST['intern_contact_number'];
        $studentID = $_POST['studentID'];
        $accountEmail = $_POST['intern_account_email'];
        $departmentId = $_POST['intern_department'];
        $password = isset($_POST['intern_password']) ? password_hash($_POST['intern_password'], PASSWORD_BCRYPT) : null;

        // Check if email already exists for other interns
        $emailCheckQuery = "SELECT COUNT(*) FROM users WHERE account_email = ? AND id != ?";
        $emailCheckStmt = $conn->prepare($emailCheckQuery);
        $emailCheckStmt->bind_param("si", $accountEmail, $id);
        $emailCheckStmt->execute();
        $emailCheckStmt->bind_result($emailCount);
        $emailCheckStmt->fetch();
        $emailCheckStmt->close();

        if ($emailCount > 0) {
            echo json_encode(['success' => false, 'message' => 'Email already in use.']);
            exit;
        }

        // Prepare the SQL update statement for the users table
        $updateQuery = "UPDATE users SET last_name=?, first_name=?, middle_name=?, suffix=?, gender=?, address=?, birthdate=?, civil_status=?, personal_email=?, contact_number=?, account_email=?, department_id=?";
        
        $params = [$lastName, $firstName, $middleName, $suffix, $gender, $address, $birthdate, $civilStatus, $personalEmail, $contactNumber, $accountEmail, $departmentId];

        // Only add password if it's provided
        if (isset($_POST['intern_password']) && $_POST['intern_password'] !== '') {
            $updateQuery .= ", password=?";
            $params[] = $password;
        }
        $updateQuery .= " WHERE id=?";
        $params[] = $id;

        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);

        // Execute the statement
        if ($stmt->execute()) {
            // Update the intern record
            $stmtIntern = $conn->prepare("UPDATE interns SET studentID=? WHERE user_id=?");
            $stmtIntern->bind_param("si", $studentID, $id);
            $stmtIntern->execute();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update intern information.']);
        }

        $stmt->close();
        $stmtIntern->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    }

    $conn->close();
?>