<?php
    session_start();
    require '../../../dbconn.php';

    // Ensure the user is logged in
    if (!isset($_SESSION['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $user_email = $_SESSION['email'];

    // Check if oldPassword is being sent (indicating password verification request)
    if (isset($_POST['oldPassword'])) {
        $old_password = $_POST['oldPassword']; // Get the old password from the form

        // Fetch the hashed password from the database
        $stmt = $conn->prepare("SELECT password FROM users WHERE account_email = ?");
        $stmt->bind_param('s', $user_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify if the entered password matches the hashed password
            if (password_verify($old_password, $hashed_password)) {
                echo json_encode(['status' => 'success', 'message' => 'Password match']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Password does not match']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        exit();
    }

    // If not a password verification request, fetch user details
    $stmt = $conn->prepare("SELECT last_name, first_name, middle_name, suffix, address, civil_status, personal_email, account_email, password FROM users WHERE account_email = ?");
    $stmt->bind_param('s', $user_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($last_name, $first_name, $middle_name, $suffix, $address, $civil_status, $personal_email, $account_email, $hashed_password);
        $stmt->fetch();

        // Combine names and handle the suffix being optional
        $full_name = $last_name . ', ' . $first_name;

        if ($middle_name) {
            $full_name .= ' ' . $middle_name;
        }

        if ($suffix) {
            $full_name .= ' ' . $suffix;
        }

        // Return all user details including the new fields
        echo json_encode([
            'status' => 'success',
            'full_name' => $full_name,
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'suffix' => $suffix,
            'address' => $address,
            'civil_status' => $civil_status,
            'personal_email' => $personal_email,
            'account_email' => $account_email
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
?>
