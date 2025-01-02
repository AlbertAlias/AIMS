<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requirement_id = $_POST['requirement_id'];
        $status = $_POST['status'];

        // Validate input
        if (empty($requirement_id) || !in_array($status, ['open', 'closed'])) {
            echo json_encode(['success' => false, 'error' => 'Invalid input']);
            exit();
        }

        // Fetch the deadline for the requirement
        $sql = "SELECT deadline FROM requirements WHERE requirement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $requirement_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $deadline = $row['deadline'];

            // Check if the deadline has passed
            if (new DateTime() > new DateTime($deadline)) {
                echo json_encode(['success' => false, 'error' => 'Cannot change status after the deadline.']);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Requirement not found']);
            exit();
        }

        // Update the status
        $sql = "UPDATE requirements SET status = ? WHERE requirement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $requirement_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update status']);
        }
    }
?>