<?php
    require_once "../../../dbconn.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $department_name = trim($_POST['department_name'] ?? '');

        if (empty($department_name)) {
            echo json_encode(['success' => false, 'error' => 'Department name is required']);
            exit;
        }

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

        $insertQuery = "INSERT INTO department (department_name) VALUES (?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("s", $department_name);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to add department.']);
        }

        $stmt->close();
        $conn->close();
    }
?>