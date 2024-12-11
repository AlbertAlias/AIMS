<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../../dbconn.php';

session_start();

// Check if student is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
    echo json_encode(["success" => false, "error" => "Unauthorized access"]);
    exit();
}

// Get the student's department_id
$student_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("
        SELECT r.title, r.description, r.created_at 
        FROM requirements r
        JOIN users u ON r.coordinator_id = u.user_id
        WHERE u.department_id = (SELECT department_id FROM users WHERE user_id = ?)
    ");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = $row;
    }

    echo json_encode(["success" => true, "requirements" => $requirements]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
