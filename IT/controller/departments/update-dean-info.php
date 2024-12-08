<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = trim($_POST['last_name']);
    $first_name = trim($_POST['first_name']);
    $dean_department = intval($_POST['dean_department']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($last_name) || empty($first_name) || empty($dean_department) || empty($username)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);
        exit;
    }

    $conn->begin_transaction();
    try {
        // Validate department
        $stmt = $conn->prepare("SELECT id FROM departments WHERE id = ?");
        $stmt->bind_param("i", $dean_department);
        $stmt->execute();
        $stmt->bind_result($department_id);
        $stmt->fetch();
        $stmt->close();

        if (!$department_id) {
            throw new Exception('Invalid department selected.');
        }

        // Validate user
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        if (!$user_id) {
            throw new Exception("User not found with the given username.");
        }

        // Update user details
        $hashed_password = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;

        if ($hashed_password) {
            $update_user_query = "UPDATE users SET last_name = ?, first_name = ?, username = ?, password = ?, department_id = ? WHERE id = ?";
            $stmt = $conn->prepare($update_user_query);
            $stmt->bind_param("ssssii", $last_name, $first_name, $username, $hashed_password, $department_id, $user_id);
        } else {
            $update_user_query = "UPDATE users SET last_name = ?, first_name = ?, username = ?, department_id = ? WHERE id = ?";
            $stmt = $conn->prepare($update_user_query);
            $stmt->bind_param("sssii", $last_name, $first_name, $username, $department_id, $user_id);
        }

        if (!$stmt->execute()) {
            throw new Exception("Failed to update user information.");
        }
        $stmt->close();

        // Update department dean
        $update_department_query = "UPDATE departments SET dean_id = ? WHERE id = ?";
        $stmt = $conn->prepare($update_department_query);
        $stmt->bind_param("ii", $user_id, $department_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update department dean information.");
        }
        $stmt->close();

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>