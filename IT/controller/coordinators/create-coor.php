<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON format.']);
        exit;
    }

    // Log received data for debugging
    error_log("Data received: " . print_r($data, true));

    // Validate all required fields
    $required_fields = ['last_name', 'first_name', 'address', 'personal_email', 'employee_no', 'department_id', 'username', 'password'];
    foreach ($required_fields as $field) {
        if (empty($data[$field])) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }
    }

    // Check for valid department
    $deptCheckStmt = $conn->prepare("SELECT id FROM dept_dean WHERE id = ?");
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

    // Validate username format: only alphanumeric and underscores, 3-15 characters
    if (!preg_match('/^[a-zA-Z0-9_]{3,15}$/', $data['username'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid username format.']);
        exit;
    }

    // Check for duplicate username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
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

    // Hash the password
    $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

    // Insert into users table
    $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, address, personal_email, employee_no, username, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'coordinator', ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error preparing user insert query: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param(
        'ssssssssi',
        $data['last_name'], $data['first_name'], $data['middle_name'], $data['address'], $data['personal_email'], 
        $data['employee_no'], $data['username'], $hashedPassword, $data['department_id']
    );

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // Insert into coordinators table
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO coordinators (user_id, department_id) VALUES (?, ?)");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing coordinator insert query: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("ii", $user_id, $data['department_id']);

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