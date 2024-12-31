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

        // Check if the new deadline is in the future
        $currentDate = new DateTime();
        $newDeadline = new DateTime($deadline);
        $status = ($newDeadline > $currentDate) ? 'open' : 'closed';

        // Update the requirement details
        $sql = "UPDATE requirements SET title = ?, description = ?, deadline = ?, status = ? WHERE requirement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $deadline, $status, $requirement_id);

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