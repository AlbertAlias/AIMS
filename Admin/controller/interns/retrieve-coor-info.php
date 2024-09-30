<?php
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    require_once '../../../dbconn.php';

    if (isset($_GET['department'])) {
        $department = $_GET['department'];

        // Query to get coordinator info based on department
        $sql = "SELECT u.first_name, u.last_name, u.personal_email
                FROM coordinators c
                JOIN users u ON c.user_id = u.id
                JOIN departments d ON c.department_id = d.id
                WHERE d.department_name = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $department);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $coordinator = $result->fetch_assoc();
            echo json_encode(['success' => true, 'coordinator' => $coordinator]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Coordinator not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'No department specified']);
    }

    $conn->close();
?>