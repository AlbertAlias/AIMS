<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/json");

// Include database connection
include '../../../dbconn.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to fetch weekly reports for the logged-in student
$sql = "
    SELECT title, week_start, week_end, file_path 
    FROM weekly_reports 
    WHERE student_id = ?
    ORDER BY week_start ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data
$reports = [];
while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
}

$stmt->close();
$conn->close();

// Return the data as JSON
echo json_encode(['status' => 'success', 'data' => $reports]);
?>