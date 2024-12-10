<?php
    include('../../../dbconn.php');

    // SQL Query to get coordinators' information
    $sql = "SELECT u.user_id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Student'";

    $result = $conn->query($sql);

    $response = array();

    // Check if the query returns any results
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $student = array(
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'department_name' => $row['department_name']
            );
            $response['students'][] = $student;
        }
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'No students found';
    }

    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>