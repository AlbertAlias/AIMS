<?php
    include '../../../dbconn.php';

    $response = ['success' => false, 'error' => ''];

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $reportId = $_POST['id'];

        // First, get the file path associated with the report to delete the file if necessary
        $sql = "SELECT file_path FROM weekly_reports WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $reportId);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($filePath);
                $stmt->fetch();

                // Delete the report record from the database
                $deleteSql = "DELETE FROM weekly_reports WHERE id = ?";
                if ($deleteStmt = $conn->prepare($deleteSql)) {
                    $deleteStmt->bind_param("i", $reportId);
                    $deleteStmt->execute();

                    // If the report was deleted successfully, delete the file (if it exists)
                    if ($deleteStmt->affected_rows > 0) {
                        if (file_exists($filePath)) {
                            unlink($filePath); // Remove the file
                        }
                        $response['success'] = true;
                    } else {
                        $response['error'] = 'Failed to delete report from database.';
                    }
                } else {
                    $response['error'] = 'Failed to prepare delete statement.';
                }
            } else {
                $response['error'] = 'Report not found.';
            }
        } else {
            $response['error'] = 'Failed to prepare select statement.';
        }
    } else {
        $response['error'] = 'Invalid report ID.';
    }

    echo json_encode($response);
    $conn->close();
?>