<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dean_id'])) {
    $dean_id = intval($_POST['dean_id']);
    error_log("Dean ID received in PHP: " . $dean_id); // Debug

    $response = [];

    // Retrieve dean details
    $deanQuery = "SELECT u.user_id, u.last_name, u.first_name, u.username
                  FROM users u
                  WHERE u.user_id = ? AND u.user_type = 'Dean'";

    $stmt = $conn->prepare($deanQuery);
    if (!$stmt) {
        error_log("Failed to prepare dean query: " . $conn->error); // Debug
        echo json_encode(['success' => false, 'error' => 'Server error.']);
        exit;
    }

    $stmt->bind_param('i', $dean_id);
    $stmt->execute();
    $deanResult = $stmt->get_result();

    if ($deanResult->num_rows > 0) {
        $dean = $deanResult->fetch_assoc();
        $response['dean'] = [
            'last_name' => $dean['last_name'],
            'first_name' => $dean['first_name'],
            'username' => $dean['username']
        ];

        // Retrieve associated departments
        $deptQuery = "SELECT d.department_id, d.department_name
                      FROM dean_department dd
                      INNER JOIN department d ON dd.department_id = d.department_id
                      WHERE dd.dean_id = ?";

        $deptStmt = $conn->prepare($deptQuery);
        if (!$deptStmt) {
            error_log("Failed to prepare department query: " . $conn->error); // Debug
            echo json_encode(['success' => false, 'error' => 'Server error.']);
            exit;
        }

        $deptStmt->bind_param('i', $dean_id);
        $deptStmt->execute();
        $deptResult = $deptStmt->get_result();

        if ($deptResult->num_rows > 0) {
            $departments = [];
            while ($row = $deptResult->fetch_assoc()) {
                $departments[] = $row;
            }
            $response['departments'] = $departments;
            $response['success'] = true;
        } else {
            error_log("No departments found for dean ID: " . $dean_id); // Debug
            $response['success'] = false;
            $response['error'] = 'No departments assigned to this dean.';
        }
    } else {
        error_log("Dean not found for ID: " . $dean_id); // Debug
        $response['success'] = false;
        $response['error'] = 'Dean not found.';
    }

    echo json_encode($response);
    $stmt->close();
    $conn->close();
} else {
    error_log("Invalid request: " . print_r($_POST, true)); // Debug
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
?>