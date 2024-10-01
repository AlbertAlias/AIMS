<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php'; // Include your database connection

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id']; // This is now the user_id

    if ($id) {
        // Delete from users first, which will cascade to coordinators
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
    }

    $conn->close();
?>