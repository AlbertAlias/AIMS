<?php
    include('../../../dbconn.php');

    // Get the supervisor ID from the AJAX request
    $user_id = $_GET['user_id'];

    // SQL query to fetch supervisor details
    $sql = "SELECT u.last_name, u.first_name, u.middle_name, u.gender, u.email, u.company, u.company_address, u.username
        FROM users u
        WHERE u.user_id = ? AND u.user_type = 'Supervisor'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = array(
            'last_name' => $row['last_name'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'gender' => $row['gender'],
            'email' => $row['email'],
            'company' => $row['company'],
            'company_address' => $row['company_address'],
            'username' => $row['username']
        );
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Supervisor not found';
    }

    $stmt->close();
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>