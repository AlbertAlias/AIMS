<?php
include '../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student_id = $_POST['student_id'];
        $evaluation_score = $_POST['evaluation_score'];
        $comments = $_POST['comments'];

        $stmt = $conn->prepare("
            INSERT INTO evaluations (student_id, evaluation_score, comments, evaluation_date)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->bind_param('sss', $student_id, $evaluation_score, $comments);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception("Database error.");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
