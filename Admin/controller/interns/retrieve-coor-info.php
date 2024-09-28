<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require_once '../../../dbconn.php';

if (isset($_GET['department'])) {
    $department = $_GET['department'];

    $sql = "SELECT first_name, last_name, personal_email FROM coordinators WHERE department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $department);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $coordinator = $result->fetch_assoc();
        echo json_encode(['success' => true, 'coordinator' => $coordinator]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Coordinator not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No department specified']);
}

$conn->close();
?>