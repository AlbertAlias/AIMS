<?php
    include '../../../../dbconn.php';
    session_start();
    header('Content-Type: application/json');

    if (isset($_POST['submit_id'], $_POST['status'])) {
        $submit_id = $_POST['submit_id'];
        $status = $_POST['status'];
        $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : null;

        $sql = "UPDATE submit_requirements SET status = ?, remarks = ? WHERE submit_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ssi', $status, $remarks, $submit_id);
            $stmt->execute();

            if ($stmt->affected_rows >= 0) {
                echo json_encode(['status' => 'success']);
            } else {
                error_log("Failed to update record: {$stmt->error}");
                echo json_encode(['status' => 'error', 'message' => 'Failed to update the record.']);
            }

            $stmt->close();
        } else {
            error_log("SQL Error: " . $conn->error);
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL query.']);
        }

        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters.']);
    }
?>