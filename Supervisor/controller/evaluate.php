<?php
// include '../../dbconn.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $student_id = $_POST['student_id'];
//         $evaluation_score = $_POST['evaluation_score'];
//         $comments = $_POST['comments'];

//         $stmt = $conn->prepare("
//             INSERT INTO evaluations (student_id, evaluation_score, comments, evaluation_date)
//             VALUES (?, ?, ?, NOW())
//         ");
//         $stmt->bind_param('sss', $student_id, $evaluation_score, $comments);
        
//         if ($stmt->execute()) {
//             echo json_encode(['success' => true]);
//         } else {
//             throw new Exception("Database error.");
//         }
//     } catch (Exception $e) {
//         http_response_code(500);
//         echo json_encode(['error' => $e->getMessage()]);
//     }
// }



// include '../../dbconn.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $student_id = $_POST['student_id'];
//         $quality_of_work = $_POST['quality_of_work'];
//         $productivity = $_POST['productivity'];
//         $work_habits = $_POST['work_habits'];
//         $interpersonal_relationships = $_POST['interpersonal_relationships'];
//         $total_grade = $_POST['total_grade'];
//         $comments = $_POST['comments'];

//         $stmt = $conn->prepare("
//             INSERT INTO evaluations 
//             (student_id, quality_of_work, productivity, work_habits, interpersonal_relationships, total_grade, comments, evaluation_date)
//             VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
//         ");
        
//         $stmt->bind_param('sssssss', 
//             $student_id, 
//             $quality_of_work, 
//             $productivity, 
//             $work_habits, 
//             $interpersonal_relationships, 
//             $total_grade, 
//             $comments
//         );

//         if ($stmt->execute()) {
//             echo json_encode(['success' => true]);
//         } else {
//             throw new Exception("Database error.");
//         }
//     } catch (Exception $e) {
//         http_response_code(500);
//         echo json_encode(['error' => $e->getMessage()]);
//     }
// }







include '../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student_id = $_POST['student_id'];
        $ratings = json_decode($_POST['ratings'], true);
        $totalGrade = $_POST['totalGrade'];
        $comments = $_POST['comments'];

        $stmt = $conn->prepare("
            INSERT INTO evaluations (student_id, ratings, total_grade, comments, evaluation_date)
            VALUES (?, ?, ?, ?, NOW())
        ");
        $ratings_string = json_encode($ratings); // Store ratings in JSON format

        $stmt->bind_param('ssss', $student_id, $ratings_string, $totalGrade, $comments);

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
