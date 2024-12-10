<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../../../dbconn.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file is uploaded and there are no errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        $studentId = $_POST['student_id'];
        $documentName = $_POST['document_name'];
        
        // Move the uploaded file to a directory (e.g., "uploads/")
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($file['name']);

        // Check if the directory is writable
        if (!is_writable($uploadDir)) {
            echo json_encode(['success' => false, 'message' => 'Upload directory is not writable.']);
            exit;
        }

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // File successfully uploaded, now save info in the database
            $sql = "INSERT INTO submit_requirements (student_id, document_name, status) 
                    VALUES (?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $studentId, $documentName);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database insert failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'File upload failed.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or file error.']);
    }
}
?>
