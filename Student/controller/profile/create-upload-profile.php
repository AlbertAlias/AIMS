<?php
    include '../../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $user_id = $_POST['user_id'];
            error_log("User ID from POST: " . $user_id);

            $file_name = basename($_FILES['profile_picture']['name']);
            $file_tmp = $_FILES['profile_picture']['tmp_name'];
            $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

            $upload_directory = 'uploads/';
            $unique_file_name = uniqid('profile_', true) . '.' . $file_type;
            $file_path = $upload_directory . $unique_file_name;

            $allowed_types = ['jpg', 'jpeg', 'png'];
            if (in_array(strtolower($file_type), $allowed_types)) {
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE user_id = ?");
                    $stmt->bind_param("si", $unique_file_name, $user_id);

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