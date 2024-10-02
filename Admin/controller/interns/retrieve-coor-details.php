<?php
require_once '../../../dbconn.php';

if (isset($_GET['department_id'])) {
    $departmentId = intval($_GET['department_id']);

    // SQL query to retrieve coordinator details
    $sql = "
        SELECT u.first_name, u.last_name, u.personal_email
        FROM coordinators c
        JOIN users u ON c.user_id = u.id
        WHERE c.department_id = ?
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $departmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $coordinator = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'data' => $coordinator
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No coordinator found for this department.'
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request.'
    ]);
}

$conn->close();