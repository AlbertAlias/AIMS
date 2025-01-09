<?php
    include '../../../../dbconn.php';
    session_start();

    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Coordinator') {
        $coordinator_id = $_SESSION['user_id'];

        $sql = "SELECT requirement_id, title FROM requirements WHERE coordinator_id = ? AND status = 'open'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $coordinator_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $requirements = [];
            while ($row = $result->fetch_assoc()) {
                $requirements[] = $row;
            }
            echo json_encode(['status' => 'success', 'data' => $requirements]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No open requirements found.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    }
?>