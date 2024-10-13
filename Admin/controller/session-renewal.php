<?php
    session_start();
    if (isset($_SESSION['email'])) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "failed"]);
    }
?>