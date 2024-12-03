<?php
    header('Content-Type: application/json');
    // Include your database connection
    include('../../../../dbconn.php');

    $query = "SELECT first_name, last_name, student_id wROM interns";
    $result = $conn->query($query);

    $interns = [];
    while ($row = $result->fetch_assoc()) {
        $interns[] = $row;
    }

    echo json_encode($interns);
?>