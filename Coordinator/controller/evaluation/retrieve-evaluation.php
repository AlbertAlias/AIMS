<?php
// retrieve-evaluation.php

include '../../../dbconn.php';
session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Query to check if the student has been evaluated
    $stmt = $conn->prepare("SELECT is_evaluated FROM coordinator_evaluations WHERE student_id = ? LIMIT 1");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $stmt->bind_result($isEvaluated);
    $stmt->fetch();

    echo json_encode([
        'alreadyEvaluated' => $isEvaluated == 1
    ]);
} else {
    echo json_encode(['error' => 'No user ID provided.']);
}

?>
