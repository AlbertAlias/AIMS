<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../dbconn.php';

// Start session for logged-in user
session_start();

// Ensure coordinator is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'coordinator') {
    echo json_encode(["success" => false, "error" => "Unauthorized access"]);
    exit();
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['requirementTitle'] ?? '');
    $description = trim($_POST['requirementDescription'] ?? '');

    // Validate input
    if ($title && $description) {
        // Get the logged-in coordinator's ID from the session
        $createdBy = $_SESSION['user_id'];

        // Prepare the database query
        $stmt = $conn->prepare("INSERT INTO student_requirements (title, description, created_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $description, $createdBy);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Requirement posted successfully"]);
        } else {
            echo json_encode(["success" => false, "error" => "Database query error"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "All fields are required"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
