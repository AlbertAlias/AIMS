<?php
include '../../../dbconn.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['department_id'])) {
    $user_id = $_SESSION['user_id'];
    $department_id = $_SESSION['department_id'];

    $sql = "
        SELECT sh.hours_needed 
        FROM student_hours sh
        WHERE sh.coordinator_id IN (
            SELECT u.user_id 
            FROM users u 
            WHERE u.department_id = ?
        )
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'hours_needed' => $row['hours_needed']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found for this department']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}
?>