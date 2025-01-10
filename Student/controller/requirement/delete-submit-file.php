<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(['error' => 'Unauthorized access']);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['submit_id'])) {
            echo json_encode(['error' => 'Missing required parameters']);
            exit;
        }

        $submit_id = $_POST['submit_id'];

        $sql = "DELETE FROM submit_requirements WHERE submit_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo json_encode(['error' => 'Database query failed']);
            exit;
        }

        $stmt->bind_param("i", $submit_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to delete the file']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }
?>