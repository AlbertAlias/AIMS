<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Start session
    session_start();

    // Ensure coordinator is logged in
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
        echo json_encode(["success" => false, "error" => "Unauthorized access"]);
        exit();
    }

    // Validate the request method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the requirement_id from the POST request
        $requirementId = $_POST['requirement_id'] ?? null;

        if (!$requirementId) {
            echo json_encode(["success" => false, "error" => "Invalid requirement ID"]);
            exit();
        }

        // Prepare and execute the delete query
        try {
            $stmt = $conn->prepare("DELETE FROM requirements WHERE requirement_id = ?");
            $stmt->bind_param("i", $requirementId);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Requirement deleted successfully"]);
            } else {
                echo json_encode(["success" => false, "error" => "Failed to delete requirement"]);
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }
?>
