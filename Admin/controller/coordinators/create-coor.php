<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../../dbconn.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate all required fields
        $required_fields = ['last_name', 'first_name', 'address', 'civil_status', 'personal_email', 'coor_code', 'employee_number', 'department_id', 'username', 'password'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                exit;
            }
        }

        // Check if the coor_code already exists in the department with the same name
        $stmt = $conn->prepare("SELECT * FROM coordinators WHERE coor_code = ? AND department_id = ?");
        $stmt->bind_param("si", $data['coor_code'], $data['department_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Check if the name matches with the existing coordinator's name
            $existing_coordinator = $result->fetch_assoc();
            if ($existing_coordinator['last_name'] !== $data['last_name'] || $existing_coordinator['first_name'] !== $data['first_name']) {
                echo json_encode(['success' => false, 'message' => 'This coordinator code is already assigned to another coordinator with a different name in this department.']);
                exit;
            }
        }
        $stmt->close();

        // Validate username format: only alphanumeric and underscores, 3-15 characters
        if (!preg_match('/^[a-zA-Z0-9_]{3,15}$/', $data['username'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid username format.']);
            exit;
        }

        // Check for duplicate username
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists.']);
            exit;
        }
        $stmt->close();

        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, suffix, address, civil_status, personal_email, employee_number, username, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'coordinator', ?)");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
            exit;
        }

        $stmt->bind_param(
            'sssssssssss',
            $data['last_name'], $data['first_name'], $data['middle_name'], $data['suffix'],
            $data['address'], $data['civil_status'], $data['personal_email'], $data['employee_number'], 
            $data['username'], $hashedPassword, $data['department_id']
        );

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Insert into coordinators table
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO coordinators (user_id, coor_code, department_id) VALUES (?, ?, ?)");
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare the coordinator insert statement.']);
                exit;
            }

            $stmt->bind_param("isi", $user_id, $data['coor_code'], $data['department_id']);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Coordinator added successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add coordinator record. Error: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement.']);
        }

        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>