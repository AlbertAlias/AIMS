<?php
    include('../../../dbconn.php');

    // Get the Registrar ID from the AJAX request
    $user_id = $_GET['user_id'];

    // SQL query to fetch Registrar details
    $sql = "SELECT u.last_name, u.first_name, u.email, u.username
        FROM users u
        WHERE u.user_id = ? AND u.user_type = 'Registrar'";

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
            'email' => $row['email'],
            'username' => $row['username']
        );
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Registrar not found';
    }

    $stmt->close();
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>