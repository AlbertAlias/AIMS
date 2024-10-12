<?php
    include('../../../dbconn.php');
    session_start();

    if (!isset($_SESSION['email'])) {
        echo json_encode(['error' => 'User not logged in']);
        exit();
    }

    $accountEmail = $_SESSION['email'];

    // Prepare SQL to fetch the admin's first and last name
    $sql = "SELECT u.first_name, u.last_name 
            FROM admins a
            JOIN users u ON a.user_id = u.id
            WHERE u.account_email = ?";

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