<?php
    require '../../../dbconn.php';

    $response = [
        'success' => false,
        'data' => [],
        'message' => ''
    ];

    try {
        // SQL query to fetch unique user types
        $sql = "SELECT DISTINCT user_type FROM users WHERE user_type IS NOT NULL";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Fetch data and store in the response
            while ($row = $result->fetch_assoc()) {
                $response['data'][] = $row['user_type'];
            }
            $response['success'] = true;
        } else {
            $response['message'] = "No user types found.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close the database connection
    $conn->close();
?>