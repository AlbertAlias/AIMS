<?php
header('Content-Type: application/json');
require_once '../../../dbconn.php'; // Adjust the path to your DB connection

$query = "SELECT id, last_name, first_name FROM admins"; // Adjust the query as needed
$result = $conn->query($query);

$admins = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}

echo json_encode($admins);
$conn->close();
?>
