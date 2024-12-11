<?php
    session_start();
    include '../../../dbconn.php'; // Include database connection

    // Ensure the user is logged in as a Coordinator
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
        die(json_encode(['error' => 'You must be logged in as a Coordinator']));
    }

    // Get the coordinator's department ID from the session
    $coordinator_id = $_SESSION['user_id'];
    $sql = "SELECT department_id FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coordinator_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die(json_encode(['error' => 'Invalid Coordinator']));
    }
    $department = $result->fetch_assoc()['department_id'];

    // Query to retrieve student requirements from the same department
    $sql = "
        SELECT sr.submit_id, sr.document_name, sr.status, 
            CONCAT(u.last_name, ', ', u.first_name, ' ', u.middle_name) AS student_name
        FROM submit_requirements sr
        INNER JOIN users u ON sr.student_id = u.user_id
        WHERE u.department_id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department);
    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = [
            'submit_id' => $row['submit_id'],
            'document_name' => $row['document_name'],
            'status' => $row['status'],
            'student_name' => $row['student_name']
        ];
    }

    echo json_encode($requirements);

    $stmt->close();
    $conn->close();
?>
