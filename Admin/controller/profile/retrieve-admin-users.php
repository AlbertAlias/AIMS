<?php
session_start();
require '../../../dbconn.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare and execute the query
    $stmt = $conn->prepare(
        "SELECT users.first_name, users.last_name 
                FROM admins 
                INNER JOIN users ON admins.user_id = users.id 
                WHERE users.username = ?
    ");
    
    $stmt->bind_param('s', $username);
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
