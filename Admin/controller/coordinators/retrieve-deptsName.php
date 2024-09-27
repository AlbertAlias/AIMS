<?php
require_once '../../../dbconn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT id, department_name FROM departments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
    echo json_encode(['departments' => $departments]);
} else {
    echo json_encode(['departments' => []]);
}

$conn->close();
?>