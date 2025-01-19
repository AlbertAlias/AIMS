<?php
include '../../../dbconn.php';

// Start the session to get the logged-in user
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

$student_id = $_SESSION['user_id'];

// SQL query to retrieve approved requirements for the logged-in student
$sql = "
    SELECT document_name, submission_date, file_path, status 
    FROM submit_requirements 
    WHERE student_id = ? AND status = 'approved'
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

// Return the data as JSON
echo json_encode(['status' => 'success', 'data' => $data]);
?>
