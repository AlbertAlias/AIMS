<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../../dbconn.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate all fields
        $required_fields = ['last_name', 'first_name', 'gender', 'address', 'birthdate', 'civil_status', 'personal_email', 'contact_number', 'department_id', 'account_email', 'password', 'studentID'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                exit;
            }
        }

        // Validate email format
        if (!filter_var($data['personal_email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
            exit;
        }

        // Check for duplicate account email
        $stmt = $conn->prepare("SELECT * FROM users WHERE account_email = ?");
        $stmt->bind_param("s", $data['account_email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Intern with this email already exists.']);
            exit;
        }
        $stmt->close();

        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, personal_email, contact_number, account_email, password, user_type, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'intern', ?)");

        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
            exit;
        }

        $stmt->bind_param(
            'sssssssssssss',
            $data['last_name'], $data['first_name'], $data['middle_name'], $data['suffix'],
            $data['gender'], $data['address'], $data['birthdate'], $data['civil_status'],
            $data['personal_email'], $data['contact_number'], $data['account_email'], $hashedPassword,
            $data['department_id']
        );

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Insert into interns table
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO interns (user_id, studentID) VALUES (?, ?)");
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare the intern insert statement.']);
                exit;
            }

            // Ensure that the studentID is included in the data
            if (empty($data['studentID'])) {
                echo json_encode(['success' => false, 'message' => 'Student ID is required.']);
                exit;
            }

            $stmt->bind_param("is", $user_id, $data['studentID']);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Intern added successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add intern record. Error: ' . $stmt->error]);
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