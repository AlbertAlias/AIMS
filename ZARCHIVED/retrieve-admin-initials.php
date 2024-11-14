<?php
    include('../../../dbconn.php');
    session_start();

    if (!isset($_SESSION['email'])) {
        echo json_encode(['error' => 'User not logged in']);
        exit();
    }

    $accountEmail = $_SESSION['email'];

    // Check if the database connection was successful
    if (!$conn) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    // Prepare SQL to fetch the admin's first and last name
    $sql = "SELECT u.first_name, u.last_name, u.profile_picture
            FROM admins a
            JOIN users u ON a.user_id = u.id
            WHERE u.account_email = ?";

    $stmt = $conn->prepare($sql);

    // Check if prepare failed
    if ($stmt === false) {
        echo json_encode(['error' => 'Failed to prepare the query']);
        error_log("SQL error: " . $conn->error); // Log the actual error
        exit();
    }

    $stmt->bind_param("s", $accountEmail);

    // Check if execute failed
    if (!$stmt->execute()) {
        echo json_encode(['error' => 'Failed to execute query']);
        error_log("SQL error: " . $stmt->error); // Log the actual error
        exit();
    }

    $stmt->bind_result($firstName, $lastName, $profilePicture);
    $stmt->fetch();

    if ($firstName && $lastName) {
        // Send response with user data
        echo json_encode([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'profile_picture' => $profilePicture ?? null // Return null if there's no profile picture
        ]);
    } else {
        echo json_encode(['error' => 'No user found']);
    }

    $stmt->close();
    $conn->close();
?>
