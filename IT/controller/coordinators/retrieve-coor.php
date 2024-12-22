<?php
    include('../../../dbconn.php');

    // Get search query from the request, if any
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

    // Build the SQL query to get coordinators
    $sql = "SELECT u.user_id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Coordinator'";

    // Add filtering condition if search query is provided
    if ($searchQuery) {
        $searchQuery = $conn->real_escape_string($searchQuery);  // Escape special characters in search query
        $sql .= " AND (u.first_name LIKE '%$searchQuery%' 
                    OR u.last_name LIKE '%$searchQuery%' 
                    OR d.department_name LIKE '%$searchQuery%')";
    }

    $result = $conn->query($sql);

    $response = array();

    // Check if the query returns any results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $coordinator = array(
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'department_name' => $row['department_name']
            );
            $response['coordinators'][] = $coordinator;
        }
        $response['success'] = true;
    } else {
        $response['success'] = true; // Allow success but empty data
        $response['coordinators'] = []; // Explicitly return an empty array
        $response['message'] = 'No coordinators found.';
    }

    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>