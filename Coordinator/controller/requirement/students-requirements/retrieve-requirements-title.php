<?php
include '../../../../dbconn.php';

// Start session to retrieve the logged-in user's details
session_start();

// Check if the user is logged in and is a Coordinator
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Coordinator') {
    // Get the logged-in coordinator's user ID
    $coordinator_id = $_SESSION['user_id'];

    // SQL query to fetch requirement titles posted by the coordinator
    $sql = "SELECT requirement_id, title FROM requirements WHERE coordinator_id = ? AND status = 'open'";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $coordinator_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any records are found
    if ($result->num_rows > 0) {
        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $requirements]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No open requirements found.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
}
?>