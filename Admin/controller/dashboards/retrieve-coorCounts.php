<?php
include '../../../dbconn.php';

header('Content-Type: application/json');

// Query to count coordinators
$sql = "SELECT COUNT(*) AS count FROM coordinators";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['count' => $row['count']]);
} else {
    echo json_encode(['count' => 0]);
}

$conn->close();
?>
