<?php
require_once '../../../dbconn.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));

    $id = (int)$_POST['user_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $department_id = (int)$_POST['department_id'];
    $password = $_POST['password'];

    $department_sql = "SELECT department_id FROM department WHERE department_id = ?";
    $stmt = $conn->prepare($department_sql);
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $stmt->bind_result($valid_id);
    $stmt->fetch();
    $stmt->close();

    if (!$valid_id) {
        $response['message'] = 'Invalid department ID provided: ' . $department_id;
        echo json_encode($response);
        exit;
    }

    $conn->begin_transaction();

    try {
        // If password is provided, hash and include it in the query
        if (!empty($password)) {
            // bcrypt hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);  // Using bcrypt
            $user_sql = "UPDATE users SET last_name = ?, first_name = ?, email = ?, username = ?, password = ?, department_id = ? WHERE user_id = ?";
            $stmt = $conn->prepare($user_sql);
            $stmt->bind_param("ssssssi", $last_name, $first_name, $email, $username, $hashed_password, $department_id, $id);
        } else {
            // If password is not provided, exclude it from the query
            $user_sql = "UPDATE users SET last_name = ?, first_name = ?, email = ?, username = ?, department_id = ? WHERE user_id = ?";
            $stmt = $conn->prepare($user_sql);
            $stmt->bind_param("ssssii", $last_name, $first_name, $email, $username, $department_id, $id);
        }
        $stmt->execute();

        $conn->commit();

        $response['success'] = true;
        $response['message'] = 'Student updated successfully!';
    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = 'Error updating student: ' . $e->getMessage();
    }

    $stmt->close();
}

echo json_encode($response);
?>