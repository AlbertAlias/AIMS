<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';
    session_start();

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Invalid request.");
        }

        // Validate session
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Unauthorized user.");
        }

        // Get POST Data
        $title = $_POST['title'];  // Get the report title
        $weekStart = $_POST['week_start'];
        $weekEnd = $_POST['week_end'];
        $filePath = '';

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = time() . '_' . basename($_FILES['file']['name']);
            $filePath = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                throw new Exception("Failed to upload file.");
            }
        }

        $sql = "INSERT INTO weekly_reports (student_id, title, week_start, week_end, file_path) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issss', $_SESSION['user_id'], $title, $weekStart, $weekEnd, $filePath);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Report submitted successfully."
            ]);
        } else {
            throw new Exception("Unable to save report to database.");
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    $conn->close();
?>
