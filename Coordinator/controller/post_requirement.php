<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../dbconn.php';

// Start session
session_start();

// Ensure coordinator is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
    echo json_encode(["success" => false, "error" => "Unauthorized access"]);
    exit();
}

// Validate the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and validate input
    $title = trim($_POST['requirementTitle'] ?? '');
    $description = trim($_POST['requirementDescription'] ?? '');
    
    if (!$title || !$description) {
        echo json_encode(["success" => false, "error" => "All fields are required"]);
        exit();
    }

    // Get logged-in coordinator's ID
    $createdBy = $_SESSION['user_id'];

    // Prepare and execute database query
    try {
        $stmt = $conn->prepare(
            "INSERT INTO requirements (coordinator_id, title, description, status) VALUES (?, ?, ?, 'pending')"
        );
        $stmt->bind_param("iss", $createdBy, $title, $description);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Requirement successfully posted"]);
        } else {
            echo json_encode(["success" => false, "error" => "Database query failed"]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
