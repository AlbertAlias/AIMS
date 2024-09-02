<?php
    include '../../dbconn.php';

    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $department = $_POST['department'] ?? null;
    $studentID = $_POST['studentID'] ?? null;
    $company = $_POST['company'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $user_type = $_POST['user_type'] ?? null;

    // Debug: Log received POST data
    error_log(print_r($_POST, true));

    // Check for required fields based on user type
    if (!$firstname || !$lastname || !$email || !$password || !$user_type) {
        echo "Required fields are missing.";
        exit;
    }

    // Prepare SQL query
    $sql = "INSERT INTO users_acc (firstname, lastname, department, studentID, company, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssss", $firstname, $lastname, $department, $studentID, $company, $email, $password, $user_type);

        if ($stmt->execute()) {
            echo "User added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
?>