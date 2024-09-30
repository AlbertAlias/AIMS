<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../../dbconn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['last_name']) || empty($data['first_name']) || empty($data['gender']) ||
        empty($data['address']) || empty($data['birthdate']) || empty($data['civil_status']) ||
        empty($data['personal_email']) || empty($data['contact_number']) || empty($data['studentID']) ||
        empty($data['department']) || empty($data['coordinator_name']) || empty($data['hours_needed']) ||
        empty($data['coordinator_email']) || empty($data['internship_status']) || empty($data['account_email']) ||
        empty($data['password'])) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
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

    $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare(
        "INSERT INTO interns
        (last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status,
        personal_email, contact_number, studentID, department, coordinator_name, hours_needed,
        coordinator_email, internship_status, account_email, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    $stmt->bind_param(
        'ssssssssssssssssss', 
        $data['last_name'], $data['first_name'], $data['middle_name'], $data['suffix'],
        $data['gender'], $data['address'], $data['birthdate'], $data['civil_status'], $data['personal_email'],
        $data['contact_number'], $data['studentID'], $data['department'], $data['coordinator_name'], 
        $data['hours_needed'], $data['coordinator_email'], $data['internship_status'],
        $data['account_email'], $hashedPassword);
        
        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'message' => 'Failed to add user.']);
            exit;
        }
        
        $user_id = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare(
            "INSERT INTO interns (user_id, studentID, internship_status, coordinator_name, 
            coordinator_email, hours_needed) VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            'issssi', 
            $user_id, $data['studentID'], $data['internship_status'], 
            $data['coordinator_name'], $data['coordinator_email'], $data['hours_needed']
        );
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Intern added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add intern.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>