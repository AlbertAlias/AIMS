<?php
include '../../../dbconn.php';

// Set content type to application/json
header('Content-Type: application/json');

// Log the incoming POST data to verify
error_log("Company: " . $_POST['company']);
error_log("Supervisor ID: " . $_POST['supervisor_id']);
error_log("Student ID: " . $_POST['student_id']);

try {
    // Get the POST data (company, supervisor ID, and student ID)
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $supervisorId = isset($_POST['supervisor_id']) ? $_POST['supervisor_id'] : '';
    $studentId = isset($_POST['student_id']) ? $_POST['student_id'] : '';

    // Validate the inputs
    if (empty($company) || empty($supervisorId) || empty($studentId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data.']);
        exit();
    }

    // Prepare the SQL query to insert into the student_supervisor table
    $sql = "INSERT INTO student_supervisor (student_id, supervisor_id, company) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check for errors in preparing the statement
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'SQL preparation error: ' . $conn->error]);
        exit();
    }

    // Bind parameters
    $stmt->bind_param('iis', $studentId, $supervisorId, $company); 

    // Execute the query
    if ($stmt->execute()) {
        // If the insertion is successful
        echo json_encode(['success' => true, 'message' => 'Supervisor assigned successfully!']);
    } else {
        // If there's an issue with SQL execution, display more info
        echo json_encode(['success' => false, 'error' => 'Failed to assign supervisor. SQL Error: ' . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>