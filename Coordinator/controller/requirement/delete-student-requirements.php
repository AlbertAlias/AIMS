<?php
    include '../../../dbconn.php';

    // Check if the submit_id is provided
    if (isset($_POST['submit_id'])) {
        $submit_id = $_POST['submit_id'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Fetch the file path associated with the submission ID
            $stmt = $conn->prepare("SELECT file_path FROM submit_requirements WHERE submit_id = ?");
            $stmt->bind_param("i", $submit_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($file_path);
            $stmt->fetch();

            // Check if a record was found and file exists
            if ($file_path && file_exists($file_path)) {
                // Delete the file from the server
                unlink($file_path);
            }

            // Delete the record from the database
            $delete_stmt = $conn->prepare("DELETE FROM submit_requirements WHERE submit_id = ?");
            $delete_stmt->bind_param("i", $submit_id);
            $delete_stmt->execute();

            // Commit the transaction
            $conn->commit();

            // Return a success response
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $conn->rollback();

            // Return an error response
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        // If submit_id is not provided
        echo json_encode(['status' => 'error', 'message' => 'No submit_id provided']);
    }
?>