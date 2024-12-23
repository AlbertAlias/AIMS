<?php
    include '../../../dbconn.php'; // Include the database connection

    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Get POST data
    $departmentId = isset($_POST['department_id']) ? $_POST['department_id'] : null;
    $departmentName = isset($_POST['department_name']) ? $_POST['department_name'] : null;

    if ($departmentId && $departmentName) {
        // Prepare the update SQL query
        $sql = "UPDATE department SET department_name = ? WHERE department_id = ?";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("si", $departmentName, $departmentId);

            // Execute the query
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Department updated successfully']);
            } else {
                // Add a more specific error message to understand what failed
                echo json_encode(['success' => false, 'message' => 'Error executing the query: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error preparing SQL statement']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }

    $conn->close();
?>