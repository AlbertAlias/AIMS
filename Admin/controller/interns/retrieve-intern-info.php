<?php
require '../../../dbconn.php'; // Include your database connection

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $internId = intval($_POST['id']);

    // SQL query to join the users and interns tables
    $sql = "SELECT u.id, u.last_name, u.first_name, u.middle_name, u.suffix, u.gender, u.address, u.birthdate, 
                    u.civil_status, u.personal_email, u.contact_number, u.department_id, 
                    i.studentID, i.internship_status, i.coordinator_name, i.coordinator_email, i.hours_needed,
                    u.account_email, u.password
            FROM users u
            INNER JOIN interns i ON u.id = i.user_id
            WHERE i.id = ?";


    // Prepare and execute the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $internId);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'user' => [
                            'id' => $data['id'],
                            'last_name' => $data['last_name'],
                            'first_name' => $data['first_name'],
                            'middle_name' => $data['middle_name'],
                            'suffix' => $data['suffix'],
                            'gender' => $data['gender'],
                            'address' => $data['address'],
                            'birthdate' => $data['birthdate'],
                            'civil_status' => $data['civil_status'],
                            'personal_email' => $data['personal_email'],
                            'contact_number' => $data['contact_number'],
                            'account_email' => $data['account_email'],
                            'password' => $data['password'],
                            'department_id' => $data['department_id'],
                        ],
                        'intern' => [
                            'studentID' => $data['studentID'],
                            'internship_status' => $data['internship_status'],
                            'coordinator_name' => $data['coordinator_name'],
                            'coordinator_email' => $data['coordinator_email'],
                            'hours_needed' => $data['hours_needed'],
                        ]
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Intern not found']);
            }            
        } else {
            echo json_encode(['success' => false, 'message' => 'Execution Error: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'SQL Prepare Error: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>