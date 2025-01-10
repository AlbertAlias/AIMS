<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    session_start();

    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("User not logged in.");
        }

        $student_id = $_SESSION['user_id'];

        $sql = "SELECT wr.id, wr.student_id, wr.title, wr.week_start, wr.week_end, wr.file_path 
                FROM weekly_reports AS wr
                WHERE wr.student_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $reports = [];
            while ($row = $result->fetch_assoc()) {
                $row['file_path'] = '/AIMS/Student/controller/weeklyreport/uploads/' . basename($row['file_path']);

                $reports[] = array(
                    'id' => $row['id'],
                    'student_id' => $row['student_id'],
                    'title' => $row['title'],
                    'week_start' => $row['week_start'],
                    'week_end' => $row['week_end'],
                    'file_path' => $row['file_path']
                );
            }
            echo json_encode(['success' => true, 'data' => $reports]);
        } else {
            throw new Exception("Unable to fetch reports.");
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    $stmt->close();
    $conn->close();
?>