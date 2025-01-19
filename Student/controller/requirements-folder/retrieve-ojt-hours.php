<?php
// Include database connection
include '../../../dbconn.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

// Get the logged-in user's ID
$student_id = $_SESSION['user_id'];

// SQL query to retrieve OJT hours
$sql = "
    SELECT 
        morning_start, 
        lunch_start, 
        lunch_end, 
        afternoon_end, 
        submission_date, 
        file_path
    FROM 
        ojt_hours
    WHERE 
        student_id = ?
    ORDER BY submission_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if records exist
if ($result->num_rows > 0) {
    $ojt_hours = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['status' => 'success', 'data' => $ojt_hours]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found.']);
}

$stmt->close();
$conn->close();
?>
