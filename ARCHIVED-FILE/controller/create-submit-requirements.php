<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Handle POST request for file submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requirementId = intval($_POST['requirement_id'] ?? 0);
        $studentId = intval($_POST['student_id'] ?? 0);

        if ($requirementId && $studentId && isset($_FILES['file'])) {
            // Get file details
            $fileName = $_FILES['file']['name'];
            $fileType = $_FILES['file']['type'];
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);

            // Store file in database
            $stmt = $conn->prepare("INSERT INTO student_submissions (requirement_id, student_id, file_name, file_type, file_content) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iissb", $requirementId, $studentId, $fileName, $fileType, $fileContent);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "File submitted successfully"]);
            } else {
                echo json_encode(["success" => false, "error" => "Database error"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Invalid input data"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }
?>
