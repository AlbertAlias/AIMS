<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    try {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized access. Please log in.');
        }

        $coordinatorUserId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $query = "SELECT hours_needed FROM student_hours WHERE coordinator_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $coordinatorUserId);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            echo json_encode($data);
        } else {
            throw new Exception("Invalid request method.");
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    } finally {
        $conn->close();
    }
?>
