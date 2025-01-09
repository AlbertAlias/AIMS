<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        die(json_encode(['error' => 'You must be logged in as a student to view the file']));
    }

    $student_id = $_SESSION['user_id'];

    $sql = "SELECT requirement_id FROM submit_requirements WHERE student_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $postedRequirements = [];
    while ($row = $result->fetch_assoc()) {
        $postedRequirements[] = $row['requirement_id'];
    }

    if (!empty($postedRequirements)) {
        echo json_encode(['posted' => true, 'requirements' => $postedRequirements]);
    } else {
        echo json_encode(['posted' => false]);
    }

    $stmt->close();
    $conn->close();
?>
