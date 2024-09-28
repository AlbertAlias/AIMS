<?php
include('../../../dbconn.php');
session_start();

// Check if user email is set in session
if (!isset($_SESSION['email'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$accountEmail = $_SESSION['email'];

// Prepare SQL to fetch the admin's first and last name
$sql = "SELECT first_name, last_name FROM admins WHERE account_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $accountEmail);

if ($stmt->execute()) {
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();

    if ($firstName && $lastName) {
        echo json_encode(['first_name' => $firstName, 'last_name' => $lastName]);
    } else {
        echo json_encode(['error' => 'No user found']);
    }
} else {
    echo json_encode(['error' => 'Failed to execute query']);
}

$stmt->close();
$conn->close();
?>