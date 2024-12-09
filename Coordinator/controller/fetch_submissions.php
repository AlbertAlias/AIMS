<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../dbconn.php';

$query = "SELECT * FROM student_submissions ORDER BY submitted_at DESC";
$result = $conn->query($query);

if ($result) {
    $submissions = [];
    while ($row = $result->fetch_assoc()) {
        $submissions[] = $row;
    }
    echo json_encode(["success" => true, "submissions" => $submissions]);
} else {
    echo json_encode(["success" => false, "error" => "Could not fetch data"]);
}
?>
