<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    try {
        if (isset($_POST['id'])) {
            $reportId = $_POST['id'];
            $title = $_POST['title'];
            $weekStart = $_POST['week_start'];
            $weekEnd = $_POST['week_end'];

            $filePath = null;

            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../../../uploads/';
                $fileName = basename($_FILES['file']['name']);
                $targetFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $filePath = '/AIMS/Student/controller/weeklyreport/uploads/' . $fileName;
                } else {
                    throw new Exception("Failed to upload file.");
                }
            } else {
                if (isset($_FILES['file'])) {
                    throw new Exception("File upload error: " . $_FILES['file']['error']);
                }
            }

            error_log("Title: $title, Week Start: $weekStart, Week End: $weekEnd, File Path: $filePath");

            $sql = "UPDATE weekly_reports SET title = ?, week_start = ?, week_end = ?, file_path = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $title, $weekStart, $weekEnd, $filePath, $reportId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to update the report.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid request']);
        }
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    $conn->close();
?>