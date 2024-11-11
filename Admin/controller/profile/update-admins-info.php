<?php
session_start();
include('../../../dbconn.php');

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id && isset($_POST['last_name'], $_POST['first_name'])) {
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = isset($_POST['middle_name']) && $_POST['middle_name'] != '' ? mysqli_real_escape_string($conn, $_POST['middle_name']) : null;
    $suffix = isset($_POST['suffix']) && $_POST['suffix'] != '' ? mysqli_real_escape_string($conn, $_POST['suffix']) : null;
    $address = isset($_POST['address']) && $_POST['address'] != '' ? mysqli_real_escape_string($conn, $_POST['address']) : null;
    $civil_status = isset($_POST['civil_status']) && $_POST['civil_status'] != '' ? mysqli_real_escape_string($conn, $_POST['civil_status']) : null;
    $personal_email = isset($_POST['personal_email']) ? mysqli_real_escape_string($conn, $_POST['personal_email']) : '';
    $account_email = isset($_POST['account_email']) && $_POST['account_email'] != '' ? mysqli_real_escape_string($conn, $_POST['account_email']) : null;

    $sql = "UPDATE users SET
            last_name = '$last_name',
            first_name = '$first_name',
            middle_name = '$middle_name',
            suffix = '$suffix',
            address = '$address',
            civil_status = '$civil_status',
            personal_email = '$personal_email',
            account_email = '$account_email'
            WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        error_log("Database update failed: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Database update failed: ' . $conn->error]);
    }
} else {
    error_log('User ID or required data not provided: ' . print_r($_POST, true));
    echo json_encode(['success' => false, 'message' => 'User ID or required data not provided.']);
}
?>