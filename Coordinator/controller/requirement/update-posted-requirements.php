<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requirement_id = $_POST['requirement_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];

        if (empty($requirement_id) || empty($title) || empty($description) || empty($deadline)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required.']);
            exit;
        }

        $sql = "UPDATE requirements SET title = ?, description = ?, deadline = ? WHERE requirement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $deadline, $requirement_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Requirement updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update requirement.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    }
?>
