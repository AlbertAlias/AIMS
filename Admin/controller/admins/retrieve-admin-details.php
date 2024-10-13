<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once '../../../dbconn.php';
    header('Content-Type: application/json');

    if (isset($_GET['id'])) {
        $admin_id = intval($_GET['id']);
        $query = "SELECT u.id, u.last_name, u.first_name, u.middle_name, u.suffix, u.address, u.civil_status, u.personal_email, 
                        u.account_email, u.password, u.user_type, u.employee_number
                FROM users u JOIN admins a ON u.id = a.user_id WHERE a.id = ?";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc();

            if ($admin) {
                echo json_encode($admin);
            } else {
                echo json_encode(['error' => 'Admin not found.']);
            }
        } else {
            echo json_encode(['error' => 'Database query failed.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request.']);
    }
?>