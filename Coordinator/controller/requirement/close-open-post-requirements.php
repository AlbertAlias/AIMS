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
