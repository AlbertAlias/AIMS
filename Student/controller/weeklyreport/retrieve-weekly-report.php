<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    try {
        // Query to fetch the reports along with the title and file path
        $sql = "SELECT wr.id, wr.student_id, wr.title, wr.week_start, wr.week_end, wr.file_path 
                FROM weekly_reports AS wr";
        
        $result = $conn->query($sql);

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

    $conn->close();
?>