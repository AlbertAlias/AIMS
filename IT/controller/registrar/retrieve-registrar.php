<?php
    include('../../../dbconn.php');

    // Get the search term from the query string (if provided)
    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

    // SQL Query to get registrar information, applying the search filter if a term is provided
    $sql = "SELECT u.user_id, u.last_name, u.first_name
            FROM users u
            WHERE u.user_type = 'Registrar'";

    // Apply filter if search term is provided
    if ($searchTerm) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql .= " AND (u.first_name LIKE '%" . $searchTerm . "%' 
                    OR u.last_name LIKE '%" . $searchTerm . "%')";
    }

    $result = $conn->query($sql);

    $response = array();

    // Check if the query returns any results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registrar = array(
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name']
            );
            $response['registrar'][] = $registrar;
        }
        $response['success'] = true;
    } else {
        $response['success'] = true; // Allow success but empty data
        $response['registrar'] = []; // Explicitly return an empty array
        $response['message'] = 'No registrar found.';
    }

    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>