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

        
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Evaluator not logged in.");
        }

        $evaluator_id = $_SESSION['user_id'];

        $ratingPoints = array_sum($ratings);

        $totalGrade = ($ratingPoints / 90) * 30;

        $stmt = $conn->prepare("
            INSERT INTO coordinator_evaluations (student_id, total_grade, comments, evaluator_id, evaluation_date)
            VALUES (?, ?, ?, ?, NOW())
        ");

        $stmt->bind_param('sdss', $student_id, $totalGrade, $comments, $evaluator_id);

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
