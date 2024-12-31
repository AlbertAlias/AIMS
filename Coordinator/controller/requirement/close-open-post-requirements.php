<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requirement_id = $_POST['requirement_id'];
        $status = $_POST['status'];

        if (empty($requirement_id) || !in_array($status, ['open', 'closed'])) {
            echo json_encode(['success' => false, 'error' => 'Invalid input']);
            exit();
        }

        // Check the current status and deadline
        $sqlCheck = "SELECT deadline, status FROM requirements WHERE requirement_id = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $requirement_id);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        $requirement = $result->fetch_assoc();

        $currentDate = new DateTime();
        $deadline = new DateTime($requirement['deadline']);
        $currentStatus = $requirement['status'];

        // Prevent reopening if the deadline has passed
        if ($currentDate > $deadline && $status === 'open') {
            echo json_encode(['success' => false, 'error' => 'Deadline has passed. Requirement cannot be reopened.']);
            exit();
        }

        // Update the status
        $sqlUpdate = "UPDATE requirements SET status = ? WHERE requirement_id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $status, $requirement_id);

        if ($stmtUpdate->execute()) {
            $message = $status === 'closed'
                ? 'Requirement is now closed'
                : 'Requirement is now open';
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update status']);
        }

        $stmtCheck->close();
        $stmtUpdate->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    }
?>
