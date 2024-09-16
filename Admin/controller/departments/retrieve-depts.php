<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

$sql = "SELECT id, department_name AS name, department_head AS head FROM departments";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Query failed']);
    exit;
}

$departments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
}

echo json_encode($departments);

$conn->close();
?>