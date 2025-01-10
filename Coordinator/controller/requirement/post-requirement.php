<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    include '../../../dbconn.php';
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
        echo json_encode(["success" => false, "error" => "Unauthorized access"]);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['requirementTitle'] ?? '');
        $description = trim($_POST['requirementDescription'] ?? '');
        $deadline = $_POST['deadline'] ?? '';

        if (!$title || !$description || !$deadline) {
            echo json_encode(["success" => false, "error" => "All fields are required"]);
            exit();
        }

        $createdBy = $_SESSION['user_id'];

        try {
            $stmt = $conn->prepare(
                "INSERT INTO requirements (coordinator_id, title, description, deadline) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("isss", $createdBy, $title, $description, $deadline);

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