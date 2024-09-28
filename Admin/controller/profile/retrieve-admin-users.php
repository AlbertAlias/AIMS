<?php
session_start();
require '../../../dbconn.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT first_name, last_name FROM admins WHERE account_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name);
    $stmt->fetch();
    
    if ($first_name && $last_name) {
        echo json_encode(['status' => 'success', 'first_name' => $first_name, 'last_name' => $last_name]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No session found.']);
}
?>
