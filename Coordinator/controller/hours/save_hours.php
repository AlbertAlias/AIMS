<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    try {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized access. Please log in.');
        }

        $coordinatorUserId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hoursNeeded = $_POST['hoursNeeded'];

            $query = "INSERT INTO student_hours (coordinator_id, hours_needed) 
                    VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE hours_needed = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $coordinatorUserId, $hoursNeeded, $hoursNeeded);

            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                throw new Exception("Database error: " . $stmt->error);
            }

            $stmt->close();
        } else {
            throw new Exception("Invalid request method.");
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    } finally {
        $conn->close();
    }
?>
