<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

try {
    $sql = "SELECT id, department_name FROM departments";
    $result = $conn->query($sql);

    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }

    echo json_encode(['success' => true, 'departments' => $departments]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
$conn->close();
?>