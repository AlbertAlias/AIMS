<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aims_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    if ($conn->connect_error) {
        header('Content-Type: application/json');
        $response = ['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error];
        echo json_encode($response);
        exit();
    }
?>