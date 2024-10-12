<?php
include('../../../../dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $intern_id = mysqli_real_escape_string($conn, $_POST['intern_id']);

    // Define the directory to store uploaded files
    $upload_dir = "uploads/";

    // Store each file in the corresponding folder and save the paths in the database
    $resume = $_FILES['resume']['name'] ? $upload_dir . basename($_FILES['resume']['name']) : null;
    $application_letter = $_FILES['application_letter']['name'] ? $upload_dir . basename($_FILES['application_letter']['name']) : null;
    $medical_certification = $_FILES['medical_certification']['name'] ? $upload_dir . basename($_FILES['medical_certification']['name']) : null;
    $certification_of_completion = $_FILES['certification_of_completion']['name'] ? $upload_dir . basename($_FILES['certification_of_completion']['name']) : null;
    $memorandum_of_agreement = $_FILES['memorandum_of_agreement']['name'] ? $upload_dir . basename($_FILES['memorandum_of_agreement']['name']) : null;

    // Move uploaded files to the server
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume);
    move_uploaded_file($_FILES['application_letter']['tmp_name'], $application_letter);
    move_uploaded_file($_FILES['medical_certification']['tmp_name'], $medical_certification);
    move_uploaded_file($_FILES['certification_of_completion']['tmp_name'], $certification_of_completion);
    move_uploaded_file($_FILES['memorandum_of_agreement']['tmp_name'], $memorandum_of_agreement);

    // Insert data into the database
    $sql = "INSERT INTO requirements (intern_id, resume, application_letter, medical_certification, certification_of_completion, memorandum_of_agreement) 
            VALUES ('$intern_id', '$resume', '$application_letter', '$medical_certification', '$certification_of_completion', '$memorandum_of_agreement')";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success">Requirements submitted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>