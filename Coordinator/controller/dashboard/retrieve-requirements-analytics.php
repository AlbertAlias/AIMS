<?php
    require '../../../dbconn.php';
    session_start();

    header('Content-Type: application/json');

    error_log("Session User ID: " . ($_SESSION['user_id'] ?? 'not set'));
    error_log("Session Department ID: " . ($_SESSION['department_id'] ?? 'not set'));

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['department_id'])) {
        error_log("Unauthorized access: Missing session variables");
        echo json_encode(['error' => 'Unauthorized access']);
        exit;
    }

    $coordinator_id = $_SESSION['user_id'];
    $department_id = $_SESSION['department_id'];
    $requirement_id = $_POST['requirement_id'] ?? 'all';

    try {
        if ($requirement_id === 'all') {
            $query = "SELECT status_table.status, 
                            COUNT(sr.status) AS count 
                    FROM (SELECT 'approved' AS status 
                            UNION ALL SELECT 'rejected' 
                            UNION ALL SELECT 'pending') AS status_table
                    LEFT JOIN submit_requirements sr 
                            ON sr.status = status_table.status 
                    JOIN requirements r 
                            ON sr.requirement_id = r.requirement_id
                    JOIN users u 
                            ON sr.student_id = u.user_id
                    WHERE r.coordinator_id = ? 
                        AND u.department_id = ?
                    GROUP BY status_table.status";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $coordinator_id, $department_id);
        } else {
            $query = "SELECT status_table.status, 
                            COUNT(sr.status) AS count 
                    FROM (SELECT 'approved' AS status 
                            UNION ALL SELECT 'rejected' 
                            UNION ALL SELECT 'pending') AS status_table
                    LEFT JOIN submit_requirements sr 
                            ON sr.status = status_table.status 
                            AND sr.requirement_id = ? 
                    JOIN users u 
                            ON sr.student_id = u.user_id
                    WHERE u.department_id = ?
                    GROUP BY status_table.status";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $requirement_id, $department_id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $chartData = ['labels' => [], 'series' => []];
        while ($row = $result->fetch_assoc()) {
            $chartData['labels'][] = ucfirst($row['status']);
            $chartData['series'][] = (int)$row['count'];
        }

        if (empty($chartData['labels'])) {
            echo json_encode(['noData' => true]);
        } else {
            echo json_encode($chartData);
        }
    } catch (Exception $e) {
        error_log("Error fetching data: " . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
    }
?>