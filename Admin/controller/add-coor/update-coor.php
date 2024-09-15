<?php
include '../../../dbconn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['coordinator_id']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $civil_status = mysqli_real_escape_string($conn, $_POST['civil_status']);
    $personal_email = mysqli_real_escape_string($conn, $_POST['personal_email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $account_email = mysqli_real_escape_string($conn, $_POST['account_email']);
    // Handle password separately if needed

    $query = "UPDATE coordinators SET 
                last_name='$last_name',
                first_name='$first_name',
                middle_name='$middle_name',
                suffix='$suffix',
                gender='$gender',
                address='$address',
                birthdate='$birthdate',
                civil_status='$civil_status',
                personal_email='$personal_email',
                contact_number='$contact_number',
                department='$department',
                account_email='$account_email'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Coordinator updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>