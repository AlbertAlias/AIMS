<?php
    include '../../dbconn.php';

    // Retrieve POST data
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $department = $_POST['department'] ?? null;
    $studentID = $_POST['studentID'] ?? null;
    $company = $_POST['company'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $user_type = $_POST['user_type'] ?? null;

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