<?php
    require_once '../../../dbconn.php';
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $last_name = $conn->real_escape_string(trim($_POST['visor_last_name']));
        $first_name = $conn->real_escape_string(trim($_POST['visor_first_name']));
        $middle_name = $conn->real_escape_string(trim($_POST['visor_middle_name'] ?? ''));
        $gender = $conn->real_escape_string(trim($_POST['visor_gender']));
        $email = $conn->real_escape_string(trim($_POST['visor_personal_email']));
        $company = $conn->real_escape_string(trim($_POST['visor_company_name']));
        $company_address = $conn->real_escape_string(trim($_POST['visor_company_address']));
        $username = $conn->real_escape_string(trim($_POST['visor_username']));
        $password = password_hash(trim($_POST['visor_password']), PASSWORD_BCRYPT);

        if (empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || empty($company_address) || empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
            exit;
        }

        $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists. Please choose another.']);
            exit;
        }

        $query = "INSERT INTO users (last_name, first_name, middle_name, gender, email, company, company_address, username, password, user_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Supervisor')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $last_name, $first_name, $middle_name, $gender, $email, $company, $company_address, $username, $password);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
    }

    $conn->close();
?>