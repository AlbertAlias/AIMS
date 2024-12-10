<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $deanID = $_POST['deanID'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];

    // Prepare update query
    $sql = "UPDATE users SET last_name = ?, first_name = ?, username = ? WHERE user_id = ? AND user_type = 'Dean'";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute
        $stmt->bind_param("sssi", $last_name, $first_name, $username, $deanID);

        if ($stmt->execute()) {
            // Send a success response
            echo json_encode(['success' => true, 'message' => 'Dean updated successfully']);
        } else {
            // Send an error response
            echo json_encode(['success' => false, 'message' => 'Failed to update dean']);
        }

        $stmt->close();
    } else {
        // Send an error response if query preparation fails
        echo json_encode(['success' => false, 'message' => 'Error preparing query']);
    }

    $conn->close();
} else {
    // If the request is not POST, send an error response
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>