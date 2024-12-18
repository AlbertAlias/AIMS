<?php
    include('../../../dbconn.php'); // Include the DB connection

    // Query to get requirement titles
    $query = "SELECT title FROM requirements";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $titles = [];
        while ($row = $result->fetch_assoc()) {
            $titles[] = $row['title'];
        }
        echo json_encode(['status' => 'success', 'titles' => $titles]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No titles found']);
    }

    $conn->close();
?>