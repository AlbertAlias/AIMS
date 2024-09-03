<?php
include '../../dbconn.php'; // Adjust the path as necessary

// SQL query to check if a Registrar already exists
$checkQuery = "SELECT COUNT(*) as count FROM users_acc WHERE user_type = 'Registrar'";
$checkResult = $conn->query($checkQuery);
$row = $checkResult->fetch_assoc();

if ($row['count'] > 0) {
    echo 'exists';
} else {
    echo 'not_exists';
}

$conn->close();
?>