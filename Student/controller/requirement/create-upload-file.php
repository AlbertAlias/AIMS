<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    ob_start();  // Start output buffering to prevent premature output

    include('../../../dbconn.php'); // Include your database connection file

    // Check if the user is logged in and is a student
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(['success' => false, 'message' => 'You must be logged in as a student.']);
        ob_end_flush();
        exit;
    }

    $studentId = $_SESSION['user_id'];  // Get the student ID from the session
    $documentName = $_POST['document_name'];  // Document name passed from the form

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the file is uploaded and there are no errors
        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $file = $_FILES['file'];

            // Move the uploaded file to a directory (e.g., "uploads/")
            $uploadDir = 'uploads/';
            $filePath = $uploadDir . basename($file['name']);

            // Check if the directory is writable
            if (!is_writable($uploadDir)) {
                echo json_encode(['success' => false, 'message' => 'Upload directory is not writable.']);
                ob_end_flush(); // Ensure output is sent and flush buffer
                exit;
            }

            // Debug: Check if file is uploaded successfully
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                echo json_encode(['success' => false, 'message' => 'File upload failed.', 'path' => $filePath]);
                ob_end_flush();
                exit;
            }

            // Insert file info into the database
            $sql = "INSERT INTO submit_requirements (student_id, document_name, status) 
                    VALUES (?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $studentId, $documentName);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'File uploaded successfully', 'path' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database insert failed.']);
            }
            ob_end_flush(); // Ensure output is sent and flush buffer
        } else {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or file error.']);
            ob_end_flush();
        }
    }
?>