<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    session_start();

    // Check if student is logged in
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(["success" => false, "error" => "Unauthorized access"]);
        exit();
    }

    // Get the student's ID and department ID
    $student_id = $_SESSION['user_id'];

    try {
        // Fetch only the requirements the student needs to address (pending or rejected, not closed)
        $stmt = $conn->prepare("
            SELECT r.requirement_id, r.title, r.description, r.created_at, r.deadline, u.first_name, u.last_name, COALESCE(sr.status, 'not_submitted') AS submission_status
            FROM requirements r
            JOIN users u ON r.coordinator_id = u.user_id
            LEFT JOIN submit_requirements sr 
                ON r.requirement_id = sr.requirement_id AND sr.student_id = ?
            WHERE u.department_id = (SELECT department_id FROM users WHERE user_id = ?)
            AND r.status != 'closed'  -- Exclude 'closed' requirements
            AND (sr.status IS NULL OR sr.status = 'rejected')
            ORDER BY r.created_at DESC
        ");
        $stmt->bind_param("ii", $student_id, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = $row;
        }

        // Include the requirements along with descriptions
        echo json_encode(["success" => true, "requirements" => $requirements, "studentId" => $student_id]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
?>