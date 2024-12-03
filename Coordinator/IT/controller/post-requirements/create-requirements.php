<?php
session_start();
require_once '../../../../dbconn.php'; // Include your database connection file

// Enable error reporting for debugging (remove in production)
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log'); // Update to a valid path
error_reporting(E_ALL);

header('Content-Type: application/json'); // Ensure JSON response

try {
    // Ensure the user is a coordinator
    if ($_SESSION['user_type'] !== 'coordinator') {
        echo json_encode(["status" => "error", "message" => "Access denied."]);
        exit;
    }

    // Get the logged-in user's ID
    $user_id = $_SESSION['user_id']; // User's ID from the `users` table (stored in session)

    // Fetch the `coordinator_id` and `department_id` from the `coordinators` table
    $sql = "SELECT id AS coordinator_id, department_id FROM coordinators WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($coordinator_id, $department_id);
    $stmt->fetch();
    $stmt->close();

    // Validate if the coordinator exists
    if (!$coordinator_id || !$department_id) {
        echo json_encode(["status" => "error", "message" => "Coordinator or department not found."]);
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;

        // Validate input fields
        if (empty($title) || empty($description)) {
            echo json_encode(["status" => "error", "message" => "Title and description are required."]);
            exit;
        }

        // Insert the requirement into the database
        $sql = "INSERT INTO requirements (title, description, department_id, coordinator_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $title, $description, $department_id, $coordinator_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Requirement posted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Unexpected error: " . $e->getMessage()]);
}
?>