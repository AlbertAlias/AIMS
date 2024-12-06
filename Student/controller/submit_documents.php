<?php
include '../../dbconn.php';
header('Content-Type: application/json');

// Handle POST Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requirementId = intval($_POST['requirementId'] ?? 0);
    $documents = trim($_POST['documents'] ?? '');

    if ($requirementId && $documents) {
        $stmt = $conn->prepare("INSERT INTO student_submissions (student_id, requirement_id, submitted_documents) VALUES (?, ?, ?)");
        $studentId = 1; // Replace with actual logged-in student ID in real-world apps
        $stmt->bind_param("iis", $studentId, $requirementId, $documents);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Database error"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid input"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
