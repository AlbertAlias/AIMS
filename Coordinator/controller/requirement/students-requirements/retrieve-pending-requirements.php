<?php
    include '../../../../dbconn.php';

    session_start();

    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Coordinator') {
        $department_id = $_SESSION['department_id'];
        $requirement_id = isset($_GET['requirement_id']) ? $_GET['requirement_id'] : null;
        $search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';

        // Escape the search term if present
        if (!empty($search_term)) {
            $search_term = "%" . $search_term . "%"; // Add the wildcards for the LIKE clause
        }

        // SQL query with filtering logic
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

        // Add filtering for search term
        if (!empty($search_term)) {
            $sql .= " AND (u.first_name LIKE ? OR u.last_name LIKE ?)";
        }

        // Add filtering for requirement_id
        if ($requirement_id) {
            $sql .= " AND sr.requirement_id = ?";
        }

        // Prepare and execute query
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters dynamically based on what is set
            if (!empty($search_term) && $requirement_id) {
                $stmt->bind_param('ssss', $department_id, $search_term, $search_term, $requirement_id);
            } elseif (!empty($search_term)) {
                $stmt->bind_param('sss', $department_id, $search_term, $search_term);
            } elseif ($requirement_id) {
                $stmt->bind_param('ss', $department_id, $requirement_id);
            } else {
                $stmt->bind_param('s', $department_id);
            }

            // Execute the statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $submissions = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Adjust the file path to be accessible via the correct URL
                        $row['file_path'] = '/AIMS/Student/controller/requirement/uploads/' . basename($row['file_path']);
                        $submissions[] = $row;
                    }
                    echo json_encode(['status' => 'success', 'data' => $submissions]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No pending requirements found.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error preparing query: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    }
?>

