<?php
// Get the student ID from the session
$studentId = $_SESSION['student_id']; // Assuming the student is logged in

// Fetch the submitted requirements and their approval statuses
$sql = "SELECT r.title, r.description, sr.approval_status, sr.remarks
        FROM student_requirements sr
        JOIN requirements r ON r.id = sr.requirement_id
        WHERE sr.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $studentId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='requirement'>
            <h3>{$row['title']}</h3>
            <p>{$row['description']}</p>
            <p>Status: {$row['approval_status']}</p>
            <p>Remarks: {$row['remarks']}</p>
          </div>";
}
?>
