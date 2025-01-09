<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    ob_start();

    include('../../../dbconn.php'); 

    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(['success' => false, 'message' => 'You must be logged in as a student.']);
        ob_end_flush();
        exit;
    }

    $studentId = $_SESSION['user_id'];
    $documentName = $_POST['document_name'];
    $requirementId = $_POST['requirement_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $file = $_FILES['file'];

            $uploadDir = 'uploads/';
            $filePath = $uploadDir . basename($file['name']);

            if (!is_writable($uploadDir)) {
                echo json_encode(['success' => false, 'message' => 'Upload directory is not writable.']);
                ob_end_flush();
                exit;
            }

            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                echo json_encode(['success' => false, 'message' => 'File upload failed.']);
                ob_end_flush();
                exit;
            }

            $sql = "INSERT INTO submit_requirements (student_id, document_name, status, requirement_id, file_path) 
                    VALUES (?, ?, 'pending', ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('isis', $studentId, $documentName, $requirementId, $filePath);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'File uploaded successfully', 'path' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database insert failed.']);
            }
            ob_end_flush();
        } else {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or file error.']);
            ob_end_flush();
        }
    }
?>
