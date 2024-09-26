<?php
// Display PHP errors for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../dbconn.php';

// Set the content type to JSON
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']);
    // Make sure to include the `role` column in your query if it's present in your database
    $query = "SELECT id, last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, contact_number, personal_email, account_email, password, role FROM admins WHERE id = ?";
    
    // Use the correct variable name for the database connection
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin) {
            // Send back the admin details as a JSON response
            echo json_encode($admin);
        } else {
            // Send an error message if admin not found
            echo json_encode(['error' => 'Admin not found.']);
        }
    } else {
        // Send an error message if the query failed
        echo json_encode(['error' => 'Database query failed.']);
    }
} else {
    // Send an error message if no ID was provided
    echo json_encode(['error' => 'Invalid request.']);
}
?>
