<?php
    header('Content-Type: application/json');
    session_start();
    include '../../../dbconn.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
        echo json_encode(['error' => 'You must be logged in as a student to submit hours']);
        exit();
    }

    $student_id = $_SESSION['user_id'];

    $target_dir = "uploads/";

    // Create a unique file name by appending the current timestamp to the file name
    $unique_file_name = time() . '_' . basename($_FILES["ojtfile"]["name"]);
    $target_file = $target_dir . $unique_file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // File validation
    if ($_FILES["ojtfile"]["size"] > 5000000) {  // 5 MB
        echo json_encode(['error' => "Sorry, your file is too large. Maximum size is 5MB."]);
        exit();
    }

    if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo json_encode(['error' => "Sorry, only PDF, JPG, JPEG, and PNG files are allowed."]);
        exit();
    }

    // Move the uploaded file to the server
    if (!move_uploaded_file($_FILES["ojtfile"]["tmp_name"], $target_file)) {
        echo json_encode(['error' => "Sorry, there was an error uploading your file."]);
        exit();
    }

    // Proceed with inserting data into the database
    $morningStart = $_POST['morningStart'];
    $lunchStart = $_POST['lunchStart'];
    $lunchEnd = $_POST['lunchEnd'];
    $afternoonEnd = $_POST['afternoonEnd'];
    $totalHours = $_POST['totalHours'];

    $sql = "INSERT INTO ojt_hours (student_id, morning_start, lunch_start, lunch_end, afternoon_end, total_hours, file_path)
            VALUES ('$student_id', '$morningStart', '$lunchStart', '$lunchEnd', '$afternoonEnd', '$totalHours', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => 'Hours submitted successfully.']);
    } else {
        echo json_encode(['error' => 'Error: ' . $conn->error]);
    }

    $conn->close();
?>