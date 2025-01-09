<?php
    include '../../../dbconn.php';
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];

    if ($id) {
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