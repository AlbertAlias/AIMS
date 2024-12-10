<?php
    include('../../../dbconn.php');

    // Get the coordinator ID from the AJAX request
    $user_id = $_GET['user_id'];

    // SQL query to fetch coordinator details, including department_id
    $sql = "SELECT u.last_name, u.first_name, u.middle_name, u.email, d.department_id, d.department_name, u.username
        FROM users u
        JOIN department d ON u.department_id = d.department_id
        WHERE u.user_id = ? AND u.user_type = 'Coordinator'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Bind the user ID parameter
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = array(
            'last_name' => $row['last_name'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'email' => $row['email'],
            'department_id' => $row['department_id'], // Include department_id
            'department_name' => $row['department_name'],
            'username' => $row['username']
        );
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Coordinator not found';
    }

    $stmt->close();
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>