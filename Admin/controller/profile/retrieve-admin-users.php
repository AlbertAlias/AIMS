<?php
session_start();
require '../../../dbconn.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Prepare and execute the query
    $stmt = $conn->prepare(
        "SELECT users.first_name, users.last_name 
                FROM admins 
                INNER JOIN users ON admins.user_id = users.id 
                WHERE users.account_email = ?
    ");
    
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
