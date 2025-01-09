<?php
    include '../../../dbconn.php';
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON format.']);
            exit;
        }

        error_log("Data received: " . print_r($data, true));

        $required_fields = ['last_name', 'first_name', 'personal_email', 'department_id', 'username', 'password'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                echo json_encode(['success' => false, 'message' => ucfirst($field) . ' is required.']);
                exit;
            }
        }

        $deptCheckStmt = $conn->prepare("SELECT department_id FROM department WHERE department_id = ?");
        if (!$deptCheckStmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing department query: ' . $conn->error]);
            exit;
        }
        $deptCheckStmt->bind_param("i", $data['department_id']);
        $deptCheckStmt->execute();
        $result = $deptCheckStmt->get_result();
        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid department ID.']);
            exit;
        }
        $deptCheckStmt->close();

        if (!preg_match('/^[a-zA-Z0-9_]{3,15}$/', $data['username'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid username format.']);
            exit;
        }

        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing username check query: ' . $conn->error]);
            exit;
        }
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists.']);
            exit;
        }
        $stmt->close();

        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $gender = isset($data['gender']) ? $data['gender'] : 'Other';

        $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, email, username, password, user_type, department_id) 
                                VALUES (?, ?, ?, ?, ?, ?, 'Coordinator', ?)");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing user insert query: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param(
            'ssssssi',
            $data['last_name'], $data['first_name'], $data['middle_name'], $data['personal_email'], 
            $data['username'], $hashedPassword, $data['department_id']
        );

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO coordinator (user_id) VALUES (?)");
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Error preparing coordinator insert query: ' . $conn->error]);
                exit;
            }

            $stmt->bind_param("i", $user_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Coordinator added successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add coordinator record. Error: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to execute the user insert query. Error: ' . $stmt->error]);
        }

        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>