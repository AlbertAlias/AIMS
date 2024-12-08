<?php
    require '../../../dbconn.php'; // Include database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $department_name = isset($_POST['department_name']) ? trim($_POST['department_name']) : '';

        if (empty($department_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Department name is required.']);
            exit;
        }

        // Insert the department name into the database
        $stmt = $conn->prepare("INSERT INTO department (department_name) VALUES (?)");
        $stmt->bind_param("s", $department_name);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Department added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add department. The name may already exist.']);
        }

        $stmt->close();
        $conn->close();
    }
?>