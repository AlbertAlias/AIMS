<?php
// Include your database connection
include('../../../../dbconn.php');

$query = "SELECT first_name, last_name, student_id FROM interns";
$result = $conn->query($query);

$interns = [];
while ($row = $result->fetch_assoc()) {
    $interns[] = $row;
}

header('Content-Type: application/json');
echo json_encode($interns);
?>