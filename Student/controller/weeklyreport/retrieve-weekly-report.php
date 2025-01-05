<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Start session to access the logged-in user's ID
    session_start();

    try {
        // Check if the user is logged in (i.e., user_id is set in the session)
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("User not logged in.");
        }

        // Get the logged-in user's student_id from session
        $student_id = $_SESSION['user_id'];

        // Query to fetch the reports for the logged-in student
        $sql = "SELECT wr.id, wr.student_id, wr.title, wr.week_start, wr.week_end, wr.file_path 
                FROM weekly_reports AS wr
                WHERE wr.student_id = ?";

        // Prepare the statement to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $student_id);  // Bind the student_id parameter to the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $reports = [];
            while ($row = $result->fetch_assoc()) {
                // Modify the file path by appending the base directory path
                $row['file_path'] = '/AIMS/Student/controller/weeklyreport/uploads/' . basename($row['file_path']); // Adjusted to your method

                // Add the full file URL to the report data
                $reports[] = array(
                    'id' => $row['id'],
                    'student_id' => $row['student_id'],
                    'title' => $row['title'],
                    'week_start' => $row['week_start'],
                    'week_end' => $row['week_end'],
                    'file_path' => $row['file_path'] // This now holds the full file path
                );
            }
            echo json_encode(['success' => true, 'data' => $reports]);
        } else {
            throw new Exception("Unable to fetch reports.");
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>