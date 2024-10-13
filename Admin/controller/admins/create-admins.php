<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../../dbconn.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['last_name']) || empty($data['first_name']) || empty($data['employee_number']) || empty($data['address']) || empty($data['personal_email']) || empty($data['account_email']) || empty($data['password']) || empty($data['user_type'])) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE account_email = ?");
        $stmt->bind_param("s", $data['account_email']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'User with this email already exists.']);
            exit;
        }
        $stmt->close();

        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (last_name, first_name, middle_name, suffix, address, employee_number, personal_email, account_email, password, user_type)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement for users.']);
            exit;
        }

        $stmt->bind_param('ssssssssss',
            $data['last_name'], $data['first_name'], $data['middle_name'], $data['suffix'],
            $data['address'], $data['employee_number'], $data['personal_email'], $data['account_email'], $hashedPassword,
            $data['user_type']
        );

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            if ($data['user_type'] === 'admin' || $data['user_type'] === 'sub-admin') {
                $stmt_admin = $conn->prepare("INSERT INTO admins (user_id) VALUES (?)");
                $stmt_admin->bind_param("i", $user_id);

                if ($stmt_admin->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Admin added successfully!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert into admins table.']);
                }

                $stmt_admin->close();
            } else {
                echo json_encode(['success' => true, 'message' => 'User added successfully without admin role.']);
            }

        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to execute the SQL statement for users.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>