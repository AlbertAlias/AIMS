<?php
    include '../../../dbconn.php'; // Include your database connection file

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get user ID from GET request
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

        if ($user_id > 0) {
            // Prepare and execute the SQL query to retrieve the profile picture
            $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $user_id); // Bind the user_id parameter
            $stmt->execute();
            $stmt->bind_result($profile_picture);
            $stmt->fetch();
            
            if ($profile_picture) {
                echo json_encode(['profile_picture' => $profile_picture]);
            } else {
                echo json_encode([]); // Return an empty response if no profile picture
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Invalid user ID.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request method.']);
    }

    $conn->close();
?>