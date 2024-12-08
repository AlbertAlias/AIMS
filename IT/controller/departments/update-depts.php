<?php
include '../../../dbconn.php';

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $department_name = $_POST['department_name'] ?? '';

    // Validate required fields
    if (empty($id) || empty($department_name)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    // Start database transaction
    $conn->begin_transaction();

    try {
        // Update department name in departments table
        $updateDeptQuery = "UPDATE departments SET department_name = ? WHERE id = ?";
        $deptStmt = $conn->prepare($updateDeptQuery);
        $deptStmt->bind_param('si', $department_name, $id);
        $deptStmt->execute();

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
        $conn->close();
    }
}
?>