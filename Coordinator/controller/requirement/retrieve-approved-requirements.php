<?php
    include '../../../dbconn.php';

    // SQL query to retrieve approved submissions
    $sql = "SELECT submit_id, student_id, document_name, status, submission_date, requirement_id, file_path
            FROM submit_requirements
            WHERE status = 'approved'";

    // Execute the query
    $result = $conn->query($sql);

    // Prepare an array to hold the data
    $submissions = [];

    if ($result->num_rows > 0) {
        // Fetch all approved submissions
        while ($row = $result->fetch_assoc()) {
            $submissions[] = [
                'submit_id' => $row['submit_id'],
                'document_name' => $row['document_name'],
                'status' => $row['status'],
                'submission_date' => $row['submission_date'],
                'file_path' => '/AIMS/Student/controller/requirement/uploads/' . basename($row['file_path']),
            ];
        }
        
        // Return the response as JSON
        echo json_encode(['status' => 'success', 'data' => $submissions]);
    } else {
        // If no results were found
        echo json_encode(['status' => 'error', 'message' => 'No approved submissions found.']);
    }

    // Close the database connection
    $conn->close();
?>