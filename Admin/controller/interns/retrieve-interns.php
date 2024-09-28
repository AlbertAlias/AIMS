<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    error_log("Database query failed: " . $conn->error);
    echo json_encode(['error' => 'Failed to retrieve interns: ' . $conn->error]);
}

$conn->close();
?>