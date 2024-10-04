<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

// Retrieve the POST data
$departmentName = $_POST['departmentName'] ?? '';
$departmentHead = $_POST['departmentHead'] ?? '';

// Basic validation
if (empty($departmentName) || empty($departmentHead)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.',
    ]);
    exit;
}

// Prepare SQL query
$sql = "INSERT INTO departments (department_name, department_head) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $departmentName, $departmentHead);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'departmentName' => htmlspecialchars($departmentName),
            'departmentHead' => htmlspecialchars($departmentHead),
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to insert data.',
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to prepare SQL query.',
    ]);
}

$conn->close();
?>