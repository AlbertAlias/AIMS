<?php
    require '../../../dbconn.php';
    session_start();

    header('Content-Type: application/json');

    // Debug session data
    error_log("Session User ID: " . ($_SESSION['user_id'] ?? 'not set'));
    error_log("Session Department ID: " . ($_SESSION['department_id'] ?? 'not set'));

    // Validate session variables
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['department_id'])) {
        // Log and respond with an error message
        error_log("Unauthorized access: Missing session variables");
        echo json_encode(['error' => 'Unauthorized access']);
        exit; // Stop further execution
    }

    $coordinator_id = $_SESSION['user_id'];
    $department_id = $_SESSION['department_id'];
    $requirement_id = $_POST['requirement_id'] ?? 'all'; // Default to 'all' if not provided

    try {
        if ($requirement_id === 'all') {
            // Query for all requirements for the coordinator and department
            $query = "SELECT sr.status, COUNT(*) AS count 
                    FROM submit_requirements sr
                    JOIN requirements r ON sr.requirement_id = r.requirement_id
                    JOIN users u ON sr.student_id = u.user_id
                    WHERE r.coordinator_id = ? AND u.department_id = ?
                    GROUP BY sr.status";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $coordinator_id, $department_id);
        } else {
            // Query for specific requirement
            $query = "SELECT sr.status, COUNT(*) AS count 
                    FROM submit_requirements sr
                    JOIN users u ON sr.student_id = u.user_id
                    WHERE sr.requirement_id = ? AND u.department_id = ?";
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

        echo json_encode($chartData); // Return the result as JSON
    } catch (Exception $e) {
        error_log("Error fetching data: " . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]); // Return the error
    }
?>