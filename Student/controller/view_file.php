<?php
include '../../dbconn.php';

if (isset($_GET['submission_id'])) {
    $submissionId = intval($_GET['submission_id']);
    
    $stmt = $conn->prepare("SELECT file_name, file_type, file_content FROM student_submissions WHERE id = ?");
    $stmt->bind_param("i", $submissionId);
    $stmt->execute();
    $stmt->bind_result($fileName, $fileType, $fileContent);
    $stmt->fetch();

    if ($fileContent) {
        header("Content-Type: " . $fileType);
        header("Content-Disposition: attachment; filename=" . $fileName);
        echo $fileContent;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
