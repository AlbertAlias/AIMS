<?php
include '../../../dbconn.php';

// Set content type to application/json
header('Content-Type: application/json');

try {
    // Get the POST data
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    $supervisorId = isset($_POST['supervisor_id']) ? (int) $_POST['supervisor_id'] : 0;
    $studentId = isset($_POST['student_id']) ? (int) $_POST['student_id'] : 0;

    // Validate the inputs
    if (empty($company) || $supervisorId <= 0 || $studentId <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data.']);
        exit();
    }

    // Start a transaction
    $conn->begin_transaction();

    // Delete any existing supervisor assignment for the student
    $deleteSql = "DELETE FROM student_supervisor WHERE student_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param('i', $studentId);

    if (!$deleteStmt->execute()) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => 'Failed to clear existing assignments: ' . $deleteStmt->error]);
        exit();
    }

    // Prepare the SQL query to insert the new supervisor assignment
    $insertSql = "INSERT INTO student_supervisor (student_id, supervisor_id, company) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);

    if (!$insertStmt) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => 'SQL preparation error: ' . $conn->error]);
        exit();
    }

    // Bind parameters and execute
    $insertStmt->bind_param('iis', $studentId, $supervisorId, $company);

    if (!$insertStmt->execute()) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => 'Failed to assign supervisor. SQL Error: ' . $insertStmt->error]);
        exit();
    }

    // Commit the transaction
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Supervisor assigned successfully!']);

    // Close the statements and connection
    $deleteStmt->close();
    $insertStmt->close();
    $conn->close();
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>