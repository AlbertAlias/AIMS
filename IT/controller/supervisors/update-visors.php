<?php
    include('../../../dbconn.php');

    // Get data from POST request
    $user_id = $_POST['user_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $company_address = $_POST['company_address'];
    $username = $_POST['username'];

    $response = array();

    if (empty($user_id) || empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || 
        empty($company_address) || empty($username)) {
        $response['success'] = false;
        $response['message'] = 'All required fields must be filled.';
    } else {
        // Update query
        $sql = "UPDATE users SET 
            last_name = ?,
            first_name = ?,
            middle_name = ?,
            gender = ?,
            email = ?,
            company = ?,
            company_address = ?,
            username = ?
        WHERE user_id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssssssi", $last_name, $first_name, $middle_name, $gender, $email, $company, 
                                $company_address, $username, $user_id);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to update supervisor.';
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