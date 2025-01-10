<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    ob_start();
    include('../../../dbconn.php');
    
    $response = [];

    try {
        if (!isset($_POST['last_name'], $_POST['first_name'], $_POST['username'], $_POST['password'], $_POST['department1'])) {
            throw new Exception('Missing required fields.');
        }

        $last_name = $conn->real_escape_string($_POST['last_name']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
        $department1 = $_POST['department1'];
        $department2 = !empty($_POST['department2']) ? $_POST['department2'] : null;
        $department3 = !empty($_POST['department3']) ? $_POST['department3'] : null;

        $check_username_sql = "SELECT user_id FROM users WHERE username = '$username'";
        $result = $conn->query($check_username_sql);
        if ($result->num_rows > 0) {
            throw new Exception('Username already exists');
        }

        $sql = "INSERT INTO users (last_name, first_name, username, password, user_type) 
                VALUES ('$last_name', '$first_name', '$username', '$password', 'Dean')";
        if (!$conn->query($sql)) {
            throw new Exception("Error inserting dean: " . $conn->error);
        }

        $dean_id = $conn->insert_id;

        $departments = [$department1, $department2, $department3];
        foreach ($departments as $department_id) {
            if (!empty($department_id)) {
                $dept_sql = "INSERT INTO dean_department (dean_id, department_id) VALUES ('$dean_id', '$department_id')";
                if (!$conn->query($dept_sql)) {
                    throw new Exception("Error assigning department: " . $conn->error);
                }
            }
        }

        $response['success'] = true;
    } catch (Exception $e) {
        file_put_contents('debug_log.txt', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
        $response['success'] = false;
        $response['error'] = $e->getMessage();
    }

    ob_end_clean();

    echo json_encode($response);
    $conn->close();
?>
