<?php
    include('../../../dbconn.php');

    $response = array();
    $query = "SELECT department_id, department_name FROM department";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $departments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $departments[] = array(
                'id' => $row['department_id'],
                'name' => $row['department_name']
            );
        }

        $response['success'] = true;
        $response['data'] = $departments;
    } else {
        $response['success'] = false;
        $response['error'] = 'Unable to fetch departments from the database';
    }

    echo json_encode($response);
?>