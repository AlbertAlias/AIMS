<?php
    include('../../../dbconn.php');

    // Get data from POST request
    $user_id = $_POST['user_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $department_id = $_POST['department_id'];

    $response = array();

    if (empty($user_id) || empty($last_name) || empty($first_name) || empty($email) || empty($username) || empty($department_id)) {
        $response['success'] = false;
        $response['message'] = 'All required fields must be filled.';
    } else {
        // Update query
        $sql = "UPDATE users SET 
                    last_name = ?, 
                    first_name = ?, 
                    middle_name = ?, 
                    email = ?, 
                    username = ?, 
                    department_id = ? 
                WHERE user_id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssssi", $last_name, $first_name, $middle_name, $email, $username, $department_id, $user_id);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to update coordinator.';
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to prepare statement.';
        }
    }

    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>