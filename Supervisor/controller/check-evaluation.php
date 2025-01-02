<?php
    include '../../dbconn.php';

    if (isset($_GET['user_id'])) {
        $user_id = intval($_GET['user_id']);
        $supervisorUserId = $_SESSION['user_id'];

        $evaluationQuery = "
            SELECT COUNT(*) AS evaluation_count
            FROM evaluations
            WHERE student_id = ? AND evaluator_id = ?
        ";
        $stmt = $conn->prepare($evaluationQuery);
        $stmt->bind_param('ii', $user_id, $supervisorUserId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        echo json_encode(['alreadyEvaluated' => $result['evaluation_count'] > 0]);
    }
?>
