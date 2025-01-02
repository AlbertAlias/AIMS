<?php
include('../../../dbconn.php');

// Get the current logged-in user's department
session_start();
$department_id = $_SESSION['department_id'];

// Query to retrieve hours_needed from student_hours table for students in the same department
$query = "
    SELECT sh.hours_needed
    FROM student_hours sh
    JOIN users u ON sh.coordinator_id = u.user_id
    WHERE u.department_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $department_id);
$stmt->execute();
$result = $stmt->get_result();

$hours_needed = 480;  // Assuming 480 as the fixed target hours for now

// Divide the hours_needed into 4 segments
$segments = [];
$step = $hours_needed / 4; // Dynamic step based on hours_needed
for ($i = 0; $i < 4; $i++) {
    $segments[] = $step * ($i + 1); // Create segments based on dynamic step
}

// Query to retrieve total_hours from ojt_hours table for students in the same department
$query = "
    SELECT oh.student_id, SUM(oh.total_hours) AS total_hours
    FROM ojt_hours oh
    JOIN users u ON oh.student_id = u.user_id
    WHERE u.department_id = ?
    GROUP BY oh.student_id"; // Group by student_id to aggregate total_hours for each student

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $department_id);
$stmt->execute();
$result = $stmt->get_result();

$counts = [0, 0, 0, 0]; // For each segment, count how many students are in that range

while ($row = $result->fetch_assoc()) {
    $total_hours = (int)$row['total_hours'];

    // Determine which segment the student's total_hours falls into
    for ($i = 0; $i < 4; $i++) {
        if ($total_hours <= $segments[$i]) {
            $counts[$i]++;
            break;
        }
    }
}

// Return the data as JSON
echo json_encode([
    'segments' => $segments,
    'counts' => $counts
]);

$conn->close();
?>