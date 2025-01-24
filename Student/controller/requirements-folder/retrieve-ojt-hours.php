<?php
include '../../../dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

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
    $upload_base_path = '/AIMS/Student/controller/hours/uploads/';
    foreach ($ojt_hours as &$record) {
        $record['file_path'] = $upload_base_path . basename($record['file_path']);
    }
    echo json_encode(['status' => 'success', 'data' => $ojt_hours]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records available']);
}

$stmt->close();
$conn->close();
?>