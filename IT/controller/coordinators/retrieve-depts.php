<?php
require_once "../../../dbconn.php";

// Fetch all departments
$query = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = [
            "id" => $row['department_id'],
            "name" => $row['department_name']
        ];
    }
    echo json_encode(['success' => true, 'data' => $departments]);
} else {
    echo json_encode(['success' => false, 'error' => 'No departments found.']);
}

$conn->close();
?>