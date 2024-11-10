<?php
session_start();
include('../../../dbconn.php');

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $update_fields = [];
    
    // Check for and sanitize each field, adding it to the update fields array if present
    if (isset($_POST['last_name']) && isset($_POST['first_name'])) {
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $update_fields[] = "last_name = '$last_name'";
        $update_fields[] = "first_name = '$first_name'";

        // Optional fields
        $middle_name = isset($_POST['middle_name']) && $_POST['middle_name'] !== '' ? mysqli_real_escape_string($conn, $_POST['middle_name']) : null;
        $suffix = isset($_POST['suffix']) && $_POST['suffix'] !== '' ? mysqli_real_escape_string($conn, $_POST['suffix']) : null;
        
        if ($middle_name !== null) {
            $update_fields[] = "middle_name = '$middle_name'";
        }
        if ($suffix !== null) {
            $update_fields[] = "suffix = '$suffix'";
        }
    }

    if (isset($_POST['location'])) {
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $update_fields[] = "address = '$location'";
    }

    if (isset($_POST['civil_status'])) {
        $civil_status = mysqli_real_escape_string($conn, $_POST['civil_status']);
        $update_fields[] = "civil_status = '$civil_status'";
    }

    if (isset($_POST['personal_email'])) {
        $personal_email = mysqli_real_escape_string($conn, $_POST['personal_email']);
        $update_fields[] = "personal_email = '$personal_email'";
    }

    if (isset($_POST['account_email'])) {
        $account_email = mysqli_real_escape_string($conn, $_POST['account_email']);
        $update_fields[] = "account_email = '$account_email'";
    }

    // Only proceed if there are fields to update
    if (!empty($update_fields)) {
        $sql = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE id = $user_id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            error_log("Database update failed: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Database update failed: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No fields provided for update.']);
    }
} else {
    error_log('User ID not provided.');
    echo json_encode(['success' => false, 'message' => 'User ID not provided.']);
}
?>
