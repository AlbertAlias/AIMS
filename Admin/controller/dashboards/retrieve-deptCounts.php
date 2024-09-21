<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../dbconn.php';

header('Content-Type: application/json');

$sql = "SELECT COUNT(*) AS department_count FROM departments";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['count' => $row['department_count']]);
} else {
    echo json_encode(['count' => 0]);
}

$conn->close();
?>