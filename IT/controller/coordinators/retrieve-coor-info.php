<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    require_once '../../../dbconn.php';

    if (!isset($_GET['id'])) {
        $response = ['error' => 'No ID provided'];
        echo json_encode($response);
        exit();
    }

    $coorId = $_GET['id'];

    // Updated query to remove coor_code
    $sql = "SELECT 
                u.id, 
                u.last_name, 
                u.first_name, 
                u.middle_name, 
                u.gender, 
                u.address, 
                u.personal_email, 
                u.username, 
                u.department_id, 
                u.employee_no
            FROM users u
            JOIN coordinators c ON u.id = c.user_id
            WHERE u.id = ? AND u.user_type = 'coordinator'";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $response = ['error' => 'Query preparation failed: ' . $conn->error];
        echo json_encode($response);
        exit();
    }

    $stmt->bind_param('i', $coorId);

    if (!$stmt->execute()) {
        error_log("Execute error: " . $stmt->error);
        $response = ['error' => 'Query execution failed'];
    } else {
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            $response = ['error' => 'No coordinator found or query failed'];
        } else {
            $response = $result->fetch_assoc(); // Fetch the coordinator's user details
        }
    }

    echo json_encode($response);

    $stmt->close();
    $conn->close();
?>
