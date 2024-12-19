<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

try {
    $sql = "SELECT wr.id, wr.student_id, wr.week_start, wr.week_end, wr.file_path 
            FROM weekly_reports AS wr";
    
    $result = $conn->query($sql);

    if ($result) {
        $reports = [];
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $reports]);
    } else {
        throw new Exception("Unable to fetch reports.");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$conn->close();
?>
