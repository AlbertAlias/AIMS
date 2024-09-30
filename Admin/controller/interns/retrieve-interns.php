<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);  // Disable displaying errors on the browser
ini_set('log_errors', 1);       // Enable error logging
ini_set('error_log', '/path/to/your/php-error.log');  // Set your path to error log file

header('Content-Type: application/json');
require_once '../../../dbconn.php';

$query = "SELECT id, last_name, first_name FROM interns";
$result = $conn->query($query);

$interns = [];

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $interns[] = $row;
        }
        echo json_encode($interns); 
    } else {
        echo json_encode(['error' => 'No interns found']);
    }
} else {
    error_log("Database query failed: " . $conn->error);  // Log the error to the file
    echo json_encode(['error' => 'Failed to retrieve interns']);
}

$conn->close();
?>
