<?php
require_once '../../../dbconn.php'; // Make sure this is the correct path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ids']) && !empty($_POST['ids'])) {
        // Sanitize and prepare IDs
        $ids = explode(',', $_POST['ids']);
        $ids = array_map('intval', $ids); // Ensure all IDs are integers
        
        // Get current page from POST data
        $currentPage = isset($_POST['page']) ? intval($_POST['page']) : 1;

        // Prepare a list of placeholders for the SQL query
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Query to select user types for the given IDs
        $sql = "SELECT id, user_type FROM users_acc WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
        $stmt->execute();
        $result = $stmt->get_result();

        $idsToDelete = [];
        while ($row = $result->fetch_assoc()) {
            if ($row['user_type'] !== 'Admin') {
                $idsToDelete[] = $row['id'];
            }
        }

        // Proceed with deletion only if there are non-Admin users to delete
        if (!empty($idsToDelete)) {
            $placeholders = implode(',', array_fill(0, count($idsToDelete), '?'));
            $sql = "DELETE FROM users_acc WHERE id IN ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat('i', count($idsToDelete)), ...$idsToDelete);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Users deleted successfully', 'page' => $currentPage]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete users: ' . $stmt->error, 'page' => $currentPage]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No users were deleted', 'page' => $currentPage]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No IDs provided']);
    }

    $conn->close();
}
?>