<?php
    // include '../../../dbconn.php';

    // session_start();

    // // Ensure only POST requests are processed and the user is logged in
    // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    //     $coordinatorId = $_SESSION['user_id']; // Coordinator's user ID from session

    //     // SQL query to get submissions linked to coordinator's posted requirements
    //     $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id
    //             FROM submit_requirements sr
    //             INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
    //             WHERE r.coordinator_id = ? AND sr.status = 'pending'";

    //     if ($stmt = $conn->prepare($sql)) {
    //         $stmt->bind_param("i", $coordinatorId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         // Prepare the response data
    //         $requirements = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $requirements[] = [
    //                 'submit_id' => $row['submit_id'],
    //                 'document_name' => $row['document_name'],
    //                 'status' => $row['status'],
    //                 'submission_date' => $row['submission_date'],
    //                 'student_id' => $row['student_id']
    //             ];
    //         }

    //         // Send the response
    //         if (count($requirements) > 0) {
    //             echo json_encode(['status' => 'success', 'data' => $requirements]);
    //         } else {
    //             echo json_encode(['status' => 'success', 'data' => []]); // No submissions
    //         }

    //         $stmt->close();
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
    //     }
    //     $conn->close();
    // } else {
    //     echo json_encode(['status' => 'error', 'message' => 'Unauthorized or invalid request']);
    // }
?>



<?php
    // include '../../../dbconn.php';

    // session_start();

    // // Ensure only POST requests are processed and the user is logged in
    // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    //     $coordinatorId = $_SESSION['user_id']; // Coordinator's user ID from session

    //     // SQL query to get submissions linked to coordinator's posted requirements
    //     $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id,
    //                 u.first_name, u.last_name
    //             FROM submit_requirements sr
    //             INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
    //             INNER JOIN users u ON sr.student_id = u.user_id
    //             WHERE r.coordinator_id = ? AND sr.status = 'pending'";

    //     if ($stmt = $conn->prepare($sql)) {
    //         $stmt->bind_param("i", $coordinatorId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         // Prepare the response data
    //         $requirements = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $requirements[] = [
    //                 'submit_id' => $row['submit_id'],
    //                 'document_name' => $row['document_name'],
    //                 'status' => $row['status'],
    //                 'submission_date' => $row['submission_date'],
    //                 'student_name' => $row['first_name'] . ' ' . $row['last_name'], // Concatenate names
    //                 'student_id' => $row['student_id']
    //             ];
    //         }

    //         // Send the response
    //         if (count($requirements) > 0) {
    //             echo json_encode(['status' => 'success', 'data' => $requirements]);
    //         } else {
    //             echo json_encode(['status' => 'success', 'data' => []]); // No submissions
    //         }

    //         $stmt->close();
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
    //     }
    //     $conn->close();
    // } else {
    //     echo json_encode(['status' => 'error', 'message' => 'Unauthorized or invalid request']);
    // }
?>






<?php
    include('../../../dbconn.php'); 
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Coordinator') {
        echo json_encode(['status' => 'error', 'message' => 'You must be logged in as a coordinator.']);
        exit;
    }

    $coordinatorId = $_SESSION['user_id'];

    // SQL query to retrieve student requirements along with file paths
    $sql = "SELECT sr.submit_id, sr.document_name, sr.status, sr.submission_date, sr.student_id, sr.file_path,
                u.first_name, u.last_name
            FROM submit_requirements sr
            INNER JOIN requirements r ON sr.requirement_id = r.requirement_id
            INNER JOIN users u ON sr.student_id = u.user_id
            WHERE r.coordinator_id = ? AND sr.status = 'pending'";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $coordinatorId);
        $stmt->execute();
        $result = $stmt->get_result();

        $requirements = [];
        while ($row = $result->fetch_assoc()) {
            $requirements[] = [
                'submit_id' => $row['submit_id'],
                'document_name' => $row['document_name'],
                'status' => $row['status'],
                'submission_date' => $row['submission_date'],
                'student_name' => $row['first_name'] . ' ' . $row['last_name'],
                'student_id' => $row['student_id'],
                'file_path' => '/AIMS/Student/controller/requirement/uploads/' . basename($row['file_path']),
            ];
        }

        if (count($requirements) > 0) {
            echo json_encode(['status' => 'success', 'data' => $requirements]);
        } else {
            echo json_encode(['status' => 'success', 'data' => []]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare database query']);
    }
?>
