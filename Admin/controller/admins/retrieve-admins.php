<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include '../../../dbconn.php';

$sql = "SELECT a.id, u.last_name, u.first_name
        FROM admins a
        JOIN users u ON a.user_id = u.id";

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