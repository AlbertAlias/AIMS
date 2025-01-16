<?php
include '../../../dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student_id = $_POST['student_id'];
        $ratings = json_decode($_POST['ratings'], true); 
        $comments = $_POST['comments'];

        if (!is_array($ratings) || empty($ratings)) {
            throw new Exception("Invalid ratings provided.");
        }

        $ratingPoints = array_sum($ratings);
        $totalGrade = ($ratingPoints / 90) * 30;

        $stmt = $conn->prepare(
            "INSERT INTO coordinator_evaluations (student_id, total_grade, comments, evaluation_date)
            VALUES (?, ?, ?, NOW())"
        );

        $stmt->bind_param('sds', $student_id, $totalGrade, $comments);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception("Failed to save evaluation.");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
