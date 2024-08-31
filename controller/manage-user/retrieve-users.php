<?php
    include('../../dbconn.php');

    // Query to fetch user data
    $sql = "SELECT firstname, lastname, department, studentID, company, email, password, user_type FROM users_acc";
    $result = $conn->query($sql);

    if (!$result) {
        // If there is an error with the query, output it
        die('Query Error: ' . $conn->error);
    }

    $users = array();

    // Fetch all users
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    // Return the data as JSON
    echo json_encode($users);

    $conn->close();
?>