<?php
require_once "../../../dbconn.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $department_name = trim($_POST['department_name'] ?? '');
    $deptID = $_POST['id'] ?? null; // Retrieve deptID if available

    // Validate input
    if (empty($department_name)) {
        echo json_encode(['success' => false, 'error' => 'Department name is required']);
        exit;
    }

    // Check if the department name already exists
    $checkQuery = "SELECT 1 FROM department WHERE department_name = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $department_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Department name already exists']);
        exit;
    }
    $stmt->close();

    // If deptID is set, update the existing department
    if ($deptID) {
        $updateQuery = "UPDATE department SET department_name = ? WHERE department_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $department_name, $deptID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update department.']);
        }
    } else {
        // Insert new department into the database
        $insertQuery = "INSERT INTO department (department_name) VALUES (?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("s", $department_name);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to add department.']);
        }
    }

    $stmt->close();
    $conn->close();
}
?>