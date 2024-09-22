<?php
ini_set('display_errors', 0); // Do not display errors
ini_set('log_errors', 1);     // Log errors to the server logs
error_reporting(E_ALL);       // Report all errors

header('Content-Type: application/json');  // Ensure the correct content type
require_once '../../../dbconn.php';

// Check if 'department' parameter exists
if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Query to fetch coordinator info based on department
    $sql = "SELECT first_name, last_name, personal_email FROM coordinators WHERE department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $department);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $coordinator = $result->fetch_assoc();
        echo json_encode(['success' => true, 'coordinator' => $coordinator]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Coordinator not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No department specified']);
}

$conn->close();
?>