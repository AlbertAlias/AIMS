<?php
    session_start(); // Start session to access session variables
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Use the session username to exclude the logged-in user
    $loggedInEmail = $_SESSION['username'];

    $sql = "SELECT a.id, u.last_name, u.first_name
            FROM admins a
            JOIN users u ON a.user_id = u.id
            WHERE u.username != ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $loggedInEmail); // Exclude the logged-in email
    $stmt->execute();
    $result = $stmt->get_result();

    $response = [];

    if (!$result) {
        $response = ['success' => false, 'message' => 'Query failed'];
    } else {
        $admins = [];
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
        $response = ['success' => true, 'admins' => $admins];
    }

    echo json_encode($response);

    $stmt->close();
    $conn->close();
?>