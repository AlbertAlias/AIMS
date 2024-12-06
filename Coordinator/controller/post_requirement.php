<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../dbconn.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['requirementTitle'] ?? '');
    $description = trim($_POST['requirementDescription'] ?? '');

    // Validate input
    if ($title && $description) {
        $stmt = $conn->prepare("INSERT INTO student_requirements (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);

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
