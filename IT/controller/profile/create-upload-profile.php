<?php
    include '../../../dbconn.php'; // Include your database connection file

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if file was uploaded without errors
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $user_id = $_POST['user_id']; // Get user ID from POST data
            // Use error_log for debugging instead of echoing to the response
            error_log("User ID from POST: " . $user_id); // Log to the server error log

            $file_name = basename($_FILES['profile_picture']['name']); // Get only the file name
            $file_tmp = $_FILES['profile_picture']['tmp_name'];
            $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

            // Specify the directory to save the file
            $upload_directory = 'uploads/'; // Ensure this directory exists
            $unique_file_name = uniqid('profile_', true) . '.' . $file_type; // Use a unique file name with extension
            $file_path = $upload_directory . $unique_file_name; // Full path to move the file

            // Check if file type is allowed
            $allowed_types = ['jpg', 'jpeg', 'png'];
            if (in_array(strtolower($file_type), $allowed_types)) {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($file_tmp, $file_path)) {
                    // Store only the file name in the database
                    $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
                    $stmt->bind_param("si", $unique_file_name, $user_id); // Save only the file name

                    if ($stmt->execute()) {
                        echo json_encode(['success' => 'Profile picture updated successfully.']);
                    } else {
                        echo json_encode(['error' => 'Failed to update database.']);
                    }

                    $stmt->close();
                } else {
                    echo json_encode(['error' => 'Failed to move uploaded file.']);
                }
            } else {
                echo json_encode(['error' => 'Invalid file type. Only JPG and PNG are allowed.']);
            }
        } else {
            echo json_encode(['error' => 'No file uploaded or an error occurred.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request method.']);
    }

    $conn->close();
?>