<?php
// Include your database connection
include('../../../../dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $report_content = mysqli_real_escape_string($conn, $_POST['report_content']);

    // Insert the report into the database
    $sql = "INSERT INTO weekly_reports (week, report_content) VALUES ('$week', '$report_content')";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success">Weekly report submitted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>