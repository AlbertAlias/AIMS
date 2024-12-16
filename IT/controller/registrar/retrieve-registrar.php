<?php
    include('../../../dbconn.php');

    // SQL Query to get registrar information
    $sql = "SELECT u.user_id, u.last_name, u.first_name
            FROM users u
            WHERE u.user_type = 'Registrar'";

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