<?php
session_start();
include '../../../dbconn.php'; // Include your database connection here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id']; // Assuming the student is logged in
    $week = $_POST['week'];
    $upload_dir = 'uploads/';
    $file_name = $_FILES['report']['name'];
    $file_tmp = $_FILES['report']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    // Validate file type
    $allowed_ext = ['pdf', 'docx'];
    if (in_array($file_ext, $allowed_ext)) {
        $new_file_name = uniqid() . '.' . $file_ext;
        $file_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO weekly_reports (student_id, week, file, submission_date) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iss", $student_id, $week, $new_file_name);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Report uploaded successfully!";
            } else {
                $_SESSION['error'] = "Failed to upload report. Please try again.";
            }
        } else {
            $_SESSION['error'] = "Failed to move the file.";
        }
    } else {
        $_SESSION['error'] = "Invalid file type. Only PDF and DOCX allowed.";
    }
}

header("Location: weekly-reports.php");
exit();
?>
