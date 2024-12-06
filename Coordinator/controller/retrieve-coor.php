<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../dbconn.php';

// Start session to get the logged-in coordinator's details
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Get the logged-in coordinator's ID
$coordinator_id = $_SESSION['user_id'];

// Fetch the department of the coordinator
$sql_department = "SELECT department_id FROM users WHERE id = ? AND user_type = 'coordinator'";
$stmt = $conn->prepare($sql_department);
$stmt->bind_param("i", $coordinator_id);
$stmt->execute();
$result_department = $stmt->get_result();

if ($result_department->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Coordinator not found.']);
    exit;
}

$department_id = $result_department->fetch_assoc()['department_id'];

// Fetch students belonging to the coordinator's department
$sql_students = "SELECT first_name, last_name FROM users WHERE department_id = ? AND user_type = 'student'";
$stmt = $conn->prepare($sql_students);
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result_students = $stmt->get_result();

$students = [];
if ($result_students->num_rows > 0) {
    while ($row = $result_students->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode(['success' => true, 'students' => $students]);

$stmt->close();
$conn->close();
?>
