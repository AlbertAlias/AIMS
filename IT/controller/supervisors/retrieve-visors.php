<?php
    include('../../../dbconn.php');

    // SQL Query to get supervisors' information
    $sql = "SELECT u.user_id, u.last_name, u.first_name, u.company
            FROM users u
            WHERE u.user_type = 'Supervisor'";

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