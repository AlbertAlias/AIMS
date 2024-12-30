<?php
    include '../../../dbconn.php';

    // Start session
    session_start();

    // Check if the student is logged in and has a department_id
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['department_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    // Get the department ID of the logged-in student
    $student_department_id = $_SESSION['department_id'];

    // SQL query to retrieve requirements that the student hasn't submitted or has been rejected
    $sql = "
        SELECT 
            r.requirement_id,
            CONCAT(u.first_name, ' ', u.last_name) AS full_name,
            r.title,
            r.description,
            r.deadline,
            r.status AS requirement_status
        FROM 
            requirements r
        JOIN 
            users u ON r.coordinator_id = u.user_id
        LEFT JOIN 
            submit_requirements sr ON r.requirement_id = sr.requirement_id AND sr.student_id = ?
        WHERE 
            u.department_id = ? 
            AND (sr.status IS NULL OR sr.status = 'rejected') 
            AND r.status = 'open'
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_SESSION['user_id'], $student_department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all requirements into an array
    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = $row;
    }

    // Return the result as JSON
    echo json_encode($requirements);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>
