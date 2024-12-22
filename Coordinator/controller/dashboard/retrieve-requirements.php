<?php
    require '../../../dbconn.php';
    header('Content-Type: application/json');
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'Unauthorized access']);
        exit;
    }

    $coordinator_id = $_SESSION['user_id'];

    try {
        $query = "SELECT requirement_id, title 
                FROM requirements 
                WHERE coordinator_id = ? AND status = 'open'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $coordinator_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = $row;
        }

        echo json_encode($requirements);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>