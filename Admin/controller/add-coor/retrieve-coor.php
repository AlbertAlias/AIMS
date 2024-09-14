<?php
header('Content-Type: application/json');
include '../../../dbconn.php'; // Include your database connection file

// Fetch all coordinators or specific one
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM coordinators WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $coordinator = $result->fetch_assoc();
    echo json_encode($coordinator);
} else {
    $result = $conn->query("SELECT * FROM coordinators");
    $coordinators = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($coordinators);
}
?>