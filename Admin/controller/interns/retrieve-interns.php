<?php
header('Content-Type: application/json');
require_once '../../../dbconn.php'; // Adjust the path to your DB connection

$query = "SELECT id, last_name, first_name FROM interns";
$result = $conn->query($query);

$interns = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $interns[] = $row;
    }
}

echo json_encode($interns);
$conn->close();
?>
