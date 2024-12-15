<?php
    include('../../../dbconn.php');

    $user_id = $_GET['user_id'];

    $sql = "SELECT 
                u.last_name, 
                u.first_name, 
                u.gender, 
                u.email, 
                u.student_id, 
                u.department_id,
                u.username
            FROM users u
            WHERE u.user_id = ? AND u.user_type = 'Student'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = ['success' => false, 'message' => 'Student not found', 'data' => null];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = [
            'success' => true,
            'data' => [
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'gender' => $row['gender'],
                'studentID' => $row['student_id'],
                'email' => $row['email'],
                'department_id' => $row['department_id'],
                'username' => $row['username']
            ]
        ];
    }
    $stmt->close();
    $conn->close();
    echo json_encode($response);
?>
