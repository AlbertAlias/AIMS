<?php
    include('../../../dbconn.php');
    header('Content-Type: application/json');

    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT u.user_id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Coordinator'";

    if ($searchQuery) {
        $searchQuery = $conn->real_escape_string($searchQuery);
        $sql .= " AND (u.first_name LIKE '%$searchQuery%' 
                    OR u.last_name LIKE '%$searchQuery%' 
                    OR d.department_name LIKE '%$searchQuery%')";
    }

    $result = $conn->query($sql);

    $response = array();

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
        $response['success'] = true;
        $response['coordinators'] = [];
        $response['message'] = 'No coordinators found.';
    }

    $conn->close();

    echo json_encode($response);
?>