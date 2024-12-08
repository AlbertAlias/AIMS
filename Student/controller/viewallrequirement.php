<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../dbconn.php';

$query = "SELECT id, title FROM student_requirements ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result) {
    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = $row;
    }
    echo json_encode(["success" => true, "data" => $requirements]);
} else {
    echo json_encode(["success" => false, "error" => "Error fetching requirements"]);
}
?>
