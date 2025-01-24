<?php
include '../../../dbconn.php';
session_start();

if (isset($_SESSION['department_id'])) {
    $studentDepartmentId = $_SESSION['department_id'];

    $sql = "
        SELECT u.rendered_hours
        FROM users u
        WHERE u.user_type = 'Student' AND u.department_id = ? AND u.user_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $studentDepartmentId, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hours_rendered = $row['rendered_hours'];

        echo json_encode([
            'status' => 'success',
            'hours_rendered' => $hours_rendered
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No student found for this department or no hours rendered'
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'User is not logged in.'
    ]);
}
?>