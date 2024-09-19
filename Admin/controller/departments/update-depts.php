<?php
include '../../../dbconn.php'; // Adjust to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? ''; // Get department ID
    $name = $_POST['departmentName'] ?? ''; // Get department name
    $head = $_POST['departmentHead'] ?? ''; // Get department head (if needed)

    // Check if required fields are provided
    if (empty($id) || empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    $query = "UPDATE departments SET department_name = ?, department_head = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $name, $head, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>