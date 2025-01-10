<?php
    include '../../../dbconn.php';
    header('Content-Type: application/json');

    try {
        $company = isset($_POST['company']) ? trim($_POST['company']) : '';
        $supervisorId = isset($_POST['supervisor_id']) ? (int) $_POST['supervisor_id'] : 0;
        $studentId = isset($_POST['student_id']) ? (int) $_POST['student_id'] : 0;

        if (empty($company) || $supervisorId <= 0 || $studentId <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid input data.']);
            exit();
        }

        $conn->begin_transaction();

        $deleteSql = "DELETE FROM student_supervisor WHERE student_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param('i', $studentId);

        if (!$deleteStmt->execute()) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => 'Failed to clear existing assignments: ' . $deleteStmt->error]);
            exit();
        }

        $insertSql = "INSERT INTO student_supervisor (student_id, supervisor_id, company) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);

        if (!$insertStmt) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => 'SQL preparation error: ' . $conn->error]);
            exit();
        }

        $insertStmt->bind_param('iis', $studentId, $supervisorId, $company);

        if (!$insertStmt->execute()) {
            $conn->rollback();
            echo json_encode(['success' => false, 'error' => 'Failed to assign supervisor. SQL Error: ' . $insertStmt->error]);
            exit();
        }

        $conn->commit();

        echo json_encode(['success' => true, 'message' => 'Supervisor assigned successfully!']);

        $deleteStmt->close();
        $insertStmt->close();
        $conn->close();
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
?>