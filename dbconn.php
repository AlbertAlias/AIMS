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
        error_log("Database connection failed: " . $conn->connect_error);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
        exit();
    }
?>