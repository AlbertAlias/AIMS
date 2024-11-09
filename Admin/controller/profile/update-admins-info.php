<?php
session_start();  // Start the session to access $_SESSION variables
include('../../../dbconn.php');  // Database connection

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'] ?? null;

// Check if user ID and required POST data are available
if ($user_id && isset($_POST['last_name'], $_POST['first_name'])) {
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    
    // Optional fields (middle_name and suffix can be empty)
    $middle_name = isset($_POST['middle_name']) && $_POST['middle_name'] != '' ? mysqli_real_escape_string($conn, $_POST['middle_name']) : null;
    $suffix = isset($_POST['suffix']) && $_POST['suffix'] != '' ? mysqli_real_escape_string($conn, $_POST['suffix']) : null;

    // Update query
    $sql = "UPDATE users SET
            last_name = '$last_name',
            first_name = '$first_name',
            middle_name = '$middle_name',
            suffix = '$suffix'
            WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Send success response back to AJAX
        echo json_encode(['success' => true]);
    } else {
        // If there is an error with the query
        error_log("Database update failed: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Database update failed: ' . $conn->error]);
    }
} else {
    error_log('User ID or required data not provided: ' . print_r($_POST, true));
    echo json_encode(['success' => false, 'message' => 'User ID or required data not provided.']);
}
?>