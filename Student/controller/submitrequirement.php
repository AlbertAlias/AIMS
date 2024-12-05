<?php
// Assuming the student is logged in and we know their student ID
$studentId = $_SESSION['student_id']; 

// Fetch the student's requirements
$sql = "SELECT r.id, r.title, r.description, r.requirement, sr.status
        FROM requirements r
        LEFT JOIN student_requirements sr ON r.id = sr.requirement_id AND sr.student_id = ?
        WHERE r.coordinator_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $studentId, $coordinatorId); // Assuming the coordinator's ID is available
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='requirement'>
            <h3>{$row['title']}</h3>
            <p>{$row['description']}</p>
            <a href='{$row['requirement']}' target='_blank'>Download Requirement</a>";

    // Show status and allow student to mark it as completed
    if ($row['status'] == 'pending') {
        echo "<form method='POST' action='submit_requirement.php'>
                <input type='hidden' name='requirement_id' value='{$row['id']}'>
                <button type='submit' class='btn btn-success'>Mark as Completed</button>
              </form>";
    } else {
        echo "<p>Status: Completed</p>";
    }
    
    echo "</div>";
}
?>
