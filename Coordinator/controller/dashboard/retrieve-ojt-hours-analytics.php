<?php
include('../../../dbconn.php');

session_start();
$department_id = $_SESSION['department_id'];

// Fetch the dynamic `hours_needed` value from the database
$query = "
            SELECT sh.hours_needed
            FROM student_hours sh
            JOIN users u ON sh.coordinator_id = u.user_id
            WHERE u.department_id = ?
            LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $department_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if we retrieved the `hours_needed`
if ($row = $result->fetch_assoc()) {
    $hours_needed = (int) $row['hours_needed'];
} else {
    // Return an error response if no data is found
    echo json_encode([
        'error' => 'No hours_needed value found for this department.'
    ]);
    exit();
}

// Define the segments
$segments = [];
$remaining_hours = $hours_needed - 1; // Subtract 1 hour for the last segment
$step = round($remaining_hours / 3); // Divide the remaining hours into 3 segments

// Create the first 3 segments, making sure there's no overlap
$segments[] = $step; // The first segment ends at $step
for ($i = 1; $i < 3; $i++) {
    $segments[] = $segments[$i - 1] + $step; // Each segment ends at the previous segment + $step
}

// The last segment will be exactly the hours_needed
$segments[] = $hours_needed;

// Fetch the total OJT hours per student
$query = "
            SELECT oh.student_id, SUM(oh.total_hours) AS total_hours
            FROM ojt_hours oh
            JOIN users u ON oh.student_id = u.user_id
            WHERE u.department_id = ?
            GROUP BY oh.student_id";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $department_id);
$stmt->execute();
$result = $stmt->get_result();

$counts = [0, 0, 0, 0];

while ($row = $result->fetch_assoc()) {
    $total_hours = (int) $row['total_hours'];

    for ($i = 0; $i < 4; $i++) {
        if ($total_hours <= $segments[$i]) {
            $counts[$i]++;
            break;
        }
    }
}

// Return the valid JSON response
echo json_encode([
    'segments' => $segments,
    'counts' => $counts,
    'error' => false
]);

$conn->close();
?>