<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php'; // Update to your correct database connection file path

    // Check if the user is logged in as a student
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(['error' => 'You must be logged in as a student to view the submitted hours']);
        exit;
    }

    // Get the student ID from the session
    $student_id = $_SESSION['user_id'];

    try {
        // Fetch all submitted hours for the logged-in student
        $stmt = $conn->prepare("SELECT * FROM ojt_hours WHERE student_id = ? ORDER BY submission_date DESC");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $hours = [];
        while ($row = $result->fetch_assoc()) {
            $hours[] = [
                'id' => $row['id'],
                'morning_start' => $row['morning_start'],
                'lunch_start' => $row['lunch_start'],
                'lunch_end' => $row['lunch_end'],
                'afternoon_end' => $row['afternoon_end'],
                'total_hours' => $row['total_hours'],
                'file_path' => $row['file_path'],
                'submission_date' => $row['submission_date']
            ];
        }

        echo json_encode(['success' => true, 'hours' => $hours]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to retrieve uploaded hours: ' . $e->getMessage()]);
    }
?>
