<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include '../../../dbconn.php';

// Adjust SQL query according to the actual table schema
$sql = "SELECT id, last_name, first_name FROM admins"; // Adjust field names if needed
$result = $conn->query($sql);

$response = [];

if (!$result) {
    $response = ['success' => false, 'message' => 'Query failed'];
} else {
    $admins = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
    }
    $response = ['success' => true, 'admins' => $admins];
}

echo json_encode($response);

$conn->close();
?>