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
            $totalGrade = ($ratingPoints / 90) * 70;
            $stmt = $conn->prepare("
                INSERT INTO coordinator_evaluations (student_id, ratings, total_grade, comments, evaluator_id, evaluation_date)
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            
            $ratings_json = json_encode($ratings);

            $stmt->bind_param('ssdsd', $student_id, $ratings_json, $totalGrade, $comments, $evaluator_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception("Failed to save evaluation.");
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
<<<<<<< HEAD
=======

        // Ensure evaluator is logged in
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Evaluator not logged in.");
        }

        // Get the evaluator's ID from the session
        $evaluator_id = $_SESSION['user_id'];

        // Calculate total points (sum of all ratings)
        $ratingPoints = array_sum($ratings);

        // Apply the formula to compute total_grade
        $totalGrade = ($ratingPoints / 90) * 30;

        // Prepare database query to insert evaluation data without ratings
        $stmt = $conn->prepare("
            INSERT INTO coordinator_evaluations (student_id, total_grade, comments, evaluator_id, evaluation_date)
            VALUES (?, ?, ?, ?, NOW())
        ");

        // Bind parameters to the query (corrected types)
        $stmt->bind_param('sdss', $student_id, $totalGrade, $comments, $evaluator_id);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception("Failed to save evaluation.");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
>>>>>>> 0419ebbeb57019f66c115de36449db39e898b277
    }
?>
