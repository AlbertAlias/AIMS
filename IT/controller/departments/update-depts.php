<?php
include '../../../dbconn.php';

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $department_name = $_POST['department_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $username = $_POST['username'] ?? '';

    // Validate required fields
    if (empty($id) || empty($department_name) || empty($last_name) || empty($first_name) || empty($username)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    // Start database transaction
    $conn->begin_transaction();

    try {
        // Update department name in dept_dean table
        $updateDeptQuery = "UPDATE dept_dean SET department_name = ? WHERE id = ?";
        $deptStmt = $conn->prepare($updateDeptQuery);
        $deptStmt->bind_param('si', $department_name, $id);
        $deptStmt->execute();

        // Update dean's information in users table
        $updateUserQuery = "UPDATE users SET last_name = ?, first_name = ?, username = ? WHERE id = (SELECT user_id FROM dept_dean WHERE id = ?)";
        $userStmt = $conn->prepare($updateUserQuery);
        $userStmt->bind_param('sssi', $last_name, $first_name, $username, $id);
        $userStmt->execute();

        // Commit transaction
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        // Close statements and connection
        $deptStmt->close();
        $userStmt->close();
        $conn->close();
    }
}
?>
