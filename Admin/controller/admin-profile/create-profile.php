<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    if (!isset($_SESSION['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'No session email found.']);
        exit();
    }

    include('../../../dbconn.php');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
            $fileData = file_get_contents($fileTmpPath);

            // Log file size for debugging
            error_log('File size: ' . strlen($fileData)); // Log the size of the file data

            $email = $_SESSION['email'];
            $sql = "UPDATE users_acc SET profile_picture = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('bs', $fileData, $email);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'File uploaded and stored successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error updating database: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded or upload error.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }

    $conn->close();
?>