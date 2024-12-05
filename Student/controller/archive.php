<?php
include '../../../archive.php';
header('Content-Type: application/json');

try {
    // Check if user IDs are provided
    if (isset($_POST['user_ids']) && !empty($_POST['user_ids'])) {
        $userIds = $_POST['user_ids']; // Get the array of user IDs to archive

        // Convert the array into a comma-separated string for SQL IN clause
        $userIdsStr = implode(',', array_map('intval', $userIds));

        // SQL query to update the status to 'archived'
        $sql = "UPDATE users SET status = 'archived' WHERE id IN ($userIdsStr)";
        if ($conn->query($sql)) {
            // Return success response
            echo json_encode(['success' => true]);
        } else {
            // Return error response
            echo json_encode(['success' => false, 'error' => 'Database error: ' . $conn->error]);
        }
    } else {
        // No user IDs provided
        echo json_encode(['success' => false, 'error' => 'No users selected for archiving']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$conn->close();
?>
