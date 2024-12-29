<?php
header('Content-Type: application/json');
session_start();
include '../../../dbconn.php';  // Include the database connection

// Ensure the student is logged in (based on session)
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Student') {
    die(json_encode(['error' => 'You must be logged in as a student to submit hours']));
}

// Get the student ID from the session
$student_id = $_SESSION['user_id'];  // Assuming the student's ID is stored in the session

// Handle file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["ojtfile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is a valid image or document
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["ojtfile"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(['error' => "File is not an image."]);
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo json_encode(['error' => "Sorry, file already exists."]);
    $uploadOk = 0;
}

// Check file size
if ($_FILES["ojtfile"]["size"] > 500000) { // 500 KB limit
    echo json_encode(['error' => "Sorry, your file is too large."]);
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo json_encode(['error' => "Sorry, only PDF, JPG, JPEG, and PNG files are allowed."]);
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo json_encode(['error' => "Sorry, your file was not uploaded."]);
} else {
    if (move_uploaded_file($_FILES["ojtfile"]["tmp_name"], $target_file)) {
        // Retrieve form data
        $morningStart = $_POST['morningStart'];
        $lunchStart = $_POST['lunchStart'];
        $lunchEnd = $_POST['lunchEnd'];
        $afternoonEnd = $_POST['afternoonEnd'];
        $totalHours = $_POST['totalHours'];

        // Insert the data into the database
        $sql = "INSERT INTO ojt_hours (student_id, morning_start, lunch_start, lunch_end, afternoon_end, total_hours, file_path)
                VALUES ('$student_id', '$morningStart', '$lunchStart', '$lunchEnd', '$afternoonEnd', '$totalHours', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => 'Hours submitted successfully.']);
        } else {
            echo json_encode(['error' => "Error: " . $sql . "<br>" . $conn->error]);
        }
    } else {
        echo json_encode(['error' => "Sorry, there was an error uploading your file."]);
    }
}

$conn->close();
?>
