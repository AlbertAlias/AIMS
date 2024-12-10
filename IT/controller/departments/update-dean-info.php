<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');

    include('../../../dbconn.php');

    // Get the POST data
    $dean_id = isset($_POST['dean_id']) ? intval($_POST['dean_id']) : 0;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $department1 = isset($_POST['department1']) ? $_POST['department1'] : '';
    $department2 = isset($_POST['department2']) ? $_POST['department2'] : '';
    $department3 = isset($_POST['department3']) ? $_POST['department3'] : '';

    // Validate input data
    if ($dean_id <= 0 || empty($last_name) || empty($first_name) || empty($username)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid input data.'
        ]);
        exit;
    }

    // Update the dean's details in the users table
    $updateUserQuery = "
        UPDATE users 
        SET last_name = ?, first_name = ?, username = ?
        WHERE user_id = ? AND user_type = 'Dean'
    ";

    // Prepare statement
    $stmt = $conn->prepare($updateUserQuery);
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare update query: ' . $conn->error
        ]);
        exit;
    }

    // Bind the parameters and execute
    $stmt->bind_param('sssi', $last_name, $first_name, $username, $dean_id);
    if (!$stmt->execute()) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update dean details: ' . $stmt->error
        ]);
        exit;
    }

    // Delete existing departments from the dean_department table
    $deleteDepartmentsQuery = "
        DELETE FROM dean_department WHERE dean_id = ?
    ";
    $stmt = $conn->prepare($deleteDepartmentsQuery);
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare delete query: ' . $conn->error
        ]);
        exit;
    }

    // Bind and execute the delete statement
    $stmt->bind_param('i', $dean_id);
    if (!$stmt->execute()) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete old departments: ' . $stmt->error
        ]);
        exit;
    }

    // Insert new departments for the dean
    $departments = array_filter([$department1, $department2, $department3]);
    $insertDepartmentsQuery = "
        INSERT INTO dean_department (dean_id, department_id)
        SELECT ?, department_id FROM department WHERE department_name = ?
    ";

    $stmt = $conn->prepare($insertDepartmentsQuery);
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare insert query: ' . $conn->error
        ]);
        exit;
    }

    foreach ($departments as $department) {
        $stmt->bind_param('is', $dean_id, $department);
        if (!$stmt->execute()) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to insert department: ' . $stmt->error
            ]);
            exit;
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'Dean information updated successfully.'
    ]);

    $stmt->close();
    $conn->close();
?>
