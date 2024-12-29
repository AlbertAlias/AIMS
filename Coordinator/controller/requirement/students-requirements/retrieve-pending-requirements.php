<?php
    include '../../../../dbconn.php';

    // Start session to retrieve the logged-in user's department
    session_start();

    // Check if the user is logged in and is a Coordinator
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Coordinator') {
        // Get the logged-in coordinator's department_id
        $department_id = $_SESSION['department_id'];

        // SQL query to fetch requirements from students within the same department
        $sql = "
            SELECT 
                sr.submit_id,
                CONCAT(u.first_name, ' ', u.last_name) AS student_name,
                sr.document_name,
                sr.submission_date,
                sr.status,
                sr.file_path
            FROM 
                submit_requirements sr
            JOIN 
                users u ON sr.student_id = u.user_id
            WHERE 
                u.department_id = ? AND sr.status = 'pending'
        ";

        // Prepare the statement to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $department_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any records are found
        if ($result->num_rows > 0) {
            $submissions = [];
            while ($row = $result->fetch_assoc()) {
                $row['file_path'] = '/AIMS/Student/controller/requirement/uploads/' . basename($row['file_path']);
                $submissions[] = $row;
            }
            echo json_encode(['status' => 'success', 'data' => $submissions]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No pending requirements found.']);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    }
?>