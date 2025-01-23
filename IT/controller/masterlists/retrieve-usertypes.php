<?php
    header('Content-Type: application/json');
    require '../../../dbconn.php';

    $response = [
        'success' => false,
        'data' => [],
        'message' => ''
    ];

    try {
        // SQL query to fetch unique user types excluding 'IT'
        $sql = "SELECT DISTINCT user_type FROM users WHERE user_type IS NOT NULL AND user_type != 'IT'";
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
    echo json_encode($response);

    // Close the database connection
    $conn->close();
?>