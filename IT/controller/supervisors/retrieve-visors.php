<?php
    include('../../../dbconn.php');

    // Get the search term from the query string (if provided)
    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

    // SQL Query to get supervisors' information with optional filtering by search term
    $sql = "SELECT u.user_id, u.last_name, u.first_name, u.company
            FROM users u
            WHERE u.user_type = 'Supervisor'";

    // Apply filter if search term is provided
    if ($searchTerm) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql .= " AND (u.first_name LIKE '%" . $searchTerm . "%' 
                      OR u.last_name LIKE '%" . $searchTerm . "%' 
                      OR u.company LIKE '%" . $searchTerm . "%')";
    }

    $result = $conn->query($sql);

    $response = array();

    // Check if the query returns any results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $supervisor = array(
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'company' => $row['company']
            );
            $response['supervisors'][] = $supervisor;
        }
        $response['success'] = true;
    } else {
        $response['success'] = true; // Allow success but empty data
        $response['supervisors'] = []; // Explicitly return an empty array
        $response['message'] = 'No supervisors found.';
    }

    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>