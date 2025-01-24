<?php
    include '../../../dbconn.php';
    session_start();

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        // Query to get student's details and department name
        $stmt = $conn->prepare("
                SELECT 
                    u.last_name, 
                    u.first_name, 
                    u.middle_name, 
                    d.department_name
                FROM users u
                LEFT JOIN department d ON u.department_id = d.department_id
                WHERE u.user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        // Check if data is fetched correctly
        $stmt->bind_result($last_name, $first_name, $middle_name, $department_name);
        if ($stmt->fetch()) {
            echo json_encode([
                'last_name' => $last_name,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'department_name' => $department_name
            ]);
        } else {
            echo json_encode(['error' => 'Student data not found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'No user ID provided.']);
    }
?>