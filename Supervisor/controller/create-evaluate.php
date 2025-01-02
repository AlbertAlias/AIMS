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







// include '../../dbconn.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $student_id = $_POST['student_id'];
//         $ratings = json_decode($_POST['ratings'], true);
//         $totalGrade = $_POST['totalGrade'];
//         $comments = $_POST['comments'];

//         $stmt = $conn->prepare("
//             INSERT INTO evaluations (student_id, ratings, total_grade, comments, evaluation_date)
//             VALUES (?, ?, ?, ?, NOW())
//         ");
//         $ratings_string = json_encode($ratings); // Store ratings in JSON format

//         $stmt->bind_param('ssss', $student_id, $ratings_string, $totalGrade, $comments);

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
//         $ratings = json_decode($_POST['ratings'], true);
//         $totalGrade = $_POST['totalGrade'];
//         $comments = $_POST['comments'];

//         $stmt = $conn->prepare("
//             INSERT INTO evaluations (student_id, ratings, total_grade, comments, evaluation_date)
//             VALUES (?, ?, ?, ?, NOW())
//         ");
//         $ratings_json = json_encode($ratings);

//         $stmt->bind_param('ssis', $student_id, $ratings_json, $totalGrade, $comments);

//         if ($stmt->execute()) {
//             echo json_encode(['success' => true]);
//         } else {
//             throw new Exception("Failed to save evaluation.");
//         }
//     } catch (Exception $e) {
//         http_response_code(500);
//         echo json_encode(['error' => $e->getMessage()]);
//     }
// }






// include '../../dbconn.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         // Capture POST data
//         $student_id = $_POST['student_id'];
//         $ratings = json_decode($_POST['ratings'], true);
//         $comments = $_POST['comments'];

//         // Validate and process ratings
//         if (!is_array($ratings) || empty($ratings)) {
//             throw new Exception("Invalid ratings provided.");
//         }

//         // Calculate total points (sum of all ratings)
//         $ratingPoints = array_sum($ratings);

//         // Apply the formula to compute total_grade
//         $totalGrade = ($ratingPoints / 90) * 70;

//         // Prepare database query
//         $stmt = $conn->prepare("
//             INSERT INTO evaluations (student_id, ratings, total_grade, comments, evaluation_date)
//             VALUES (?, ?, ?, ?, NOW())
//         ");
        
//         // Convert the ratings array to JSON
//         $ratings_json = json_encode($ratings);

//         // Bind parameters to the query
//         $stmt->bind_param('ssds', $student_id, $ratings_json, $totalGrade, $comments);

//         // Execute the query
//         if ($stmt->execute()) {
//             echo json_encode(['success' => true]);
//         } else {
//             throw new Exception("Failed to save evaluation.");
//         }
//     } catch (Exception $e) {
//         http_response_code(500);
//         echo json_encode(['error' => $e->getMessage()]);
//     }
// }

?>
<?php
include '../../dbconn.php';
session_start();  // Make sure session is started to capture user data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Capture POST data
        $student_id = $_POST['student_id'];
        $ratings = json_decode($_POST['ratings'], true);
        $comments = $_POST['comments'];

        // Validate and process ratings
        if (!is_array($ratings) || empty($ratings)) {
            throw new Exception("Invalid ratings provided.");
        }

        // Ensure evaluator is logged in
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Evaluator not logged in.");
        }

        // Get the evaluator's ID from the session
        $evaluator_id = $_SESSION['user_id'];

        // Calculate total points (sum of all ratings)
        $ratingPoints = array_sum($ratings);

        // Apply the formula to compute total_grade
        $totalGrade = ($ratingPoints / 90) * 70;

        $stmt = $conn->prepare("
            INSERT INTO evaluations (student_id, ratings, total_grade, comments, evaluator_id, evaluation_date)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        
        // Convert the ratings array to JSON
        $ratings_json = json_encode($ratings);

        // Bind parameters to the query
        $stmt->bind_param('ssdsd', $student_id, $ratings_json, $totalGrade, $comments, $evaluator_id);

        // Execute the query
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
