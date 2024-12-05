<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

try {
    $sql = "SELECT id, department_name FROM departments ORDER BY department_name";
    $result = $conn->query($sql);

    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }

    echo json_encode($departments);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>
