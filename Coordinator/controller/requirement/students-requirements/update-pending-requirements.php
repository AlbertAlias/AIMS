<?php
    include '../../../../dbconn.php';

    // Start session to retrieve the logged-in user's department
    session_start();
    
    // Check if the user is logged in and is a Coordinator
    if (isset($_POST['submit_id']) && isset($_POST['status'])) {
        // Get the submitted data
        $submit_id = $_POST['submit_id'];
        $status = $_POST['status'];
    
        // Prepare the SQL query to update the status
        $sql = "UPDATE submit_requirements SET status = ? WHERE submit_id = ?";
    
        // Prepare the statement to prevent SQL injection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('si', $status, $submit_id);
            $stmt->execute();
    
            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success']); // Successful update
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update or status is already set.']);
            }
    
            // Close the statement
            $stmt->close();
        } else {
            // Log the SQL error for debugging
            error_log("SQL Error: " . $conn->error);
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL query.']);
        }
    
        // Close the connection
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters.']);
    }
?>