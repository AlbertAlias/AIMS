<?php
    include '../../../dbconn.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $departmentId = isset($_POST['department_id']) ? $_POST['department_id'] : null;

    if ($departmentId) {
        $sql = "DELETE FROM department WHERE department_id = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $departmentId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Department deleted successfully']);
            } else {
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