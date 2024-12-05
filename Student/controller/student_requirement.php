<?php
// Handle the student submitting a requirement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_SESSION['student_id']; // Get student ID from session
    $requirementId = $_POST['requirement_id'];

    // Insert a record into the student_requirements table or update the status if it already exists
    $sql = "INSERT INTO student_requirements (student_id, requirement_id, status)
            VALUES (?, ?, 'completed')
            ON DUPLICATE KEY UPDATE status = 'completed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $studentId, $requirementId);
    if ($stmt->execute()) {
        echo "Requirement marked as completed.";
    } else {
        echo "Error marking requirement as completed.";
    }
}
?>
