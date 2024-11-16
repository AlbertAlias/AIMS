<?php
include '../../../dbconn.php';

if (isset($_GET['id'])) {
    $internId = $_GET['id'];

    $sql = " SELECT u.id, u.last_name, u.first_name, u.gender, u.username, i.intern_id, i.studentID, u.department_id, u.password
        FROM users u
        JOIN interns i ON u.id = i.user_id
        WHERE i.id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $internId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $intern = $result->fetch_assoc();
        echo json_encode($intern);
    } else {
        echo json_encode(['error' => 'Intern not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'No intern ID provided']);
}
