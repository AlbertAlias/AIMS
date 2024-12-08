<?php
require_once '../../../dbconn.php';

if (isset($_POST['dept_id']) && isset($_POST['department_name'])) {
    $deptId = $_POST['dept_id'];
    $departmentName = $_POST['department_name'];

    // Prepare update query
    $query = "UPDATE departments SET department_name = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("si", $departmentName, $deptId);

        if ($stmt->execute()) {
            // Return success response when the query is executed successfully
            echo json_encode(array('status' => 'success', 'message' => 'Department successfully updated.'));
        } else {
            // Return error response if query execution fails
            echo json_encode(array('status' => 'error', 'message' => 'Failed to execute query.'));
        }

        $stmt->close();
    } else {
        // Return error if preparing the query fails
        echo json_encode(array('status' => 'error', 'message' => 'Failed to prepare query.'));
    }
} else {
    // Return error if required data is missing
    echo json_encode(array('status' => 'error', 'message' => 'Missing required data.'));
}

$conn->close();
?>