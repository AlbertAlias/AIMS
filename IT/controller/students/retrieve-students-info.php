<?php
include('../../../dbconn.php');

// Get the user ID from the AJAX request
$user_id = $_GET['user_id'];

// SQL query to fetch student details, including department_id
$sql = "SELECT 
            u.last_name, 
            u.first_name, 
            u.gender, 
            u.email, 
            u.student_id, 
            u.department_id, -- Retrieve the department_id from users table
            u.username
        FROM users u
        WHERE u.user_id = ? AND u.user_type = 'Student'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Log the row for debugging
    error_log("Row fetched from DB: " . print_r($row, true));
    
    // Map the results to the response
    $response = array(
        'success' => true,
        'last_name' => $row['last_name'] ?? '',
        'first_name' => $row['first_name'] ?? '',
        'gender' => $row['gender'] ?? '',
        'studentID' => $row['student_id'] ?? '',
        'email' => $row['email'] ?? '',
        'department_id' => $row['department_id'] ?? '', // Include department_id
        'username' => $row['username'] ?? ''
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Student not found'
    );
}

$stmt->close();
$conn->close();

// Log the final JSON response for debugging
error_log("JSON Response: " . json_encode($response));

// Return the response as JSON
echo json_encode($response);
?>
