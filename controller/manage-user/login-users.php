<?php
    // require 'dbconn.php';

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     $stmt = $conn->prepare("SELECT password, user_type FROM users WHERE email = ?");
    //     $stmt->bind_param('s', $email);
    //     $stmt->execute();
    //     $stmt->store_result();

    //     if ($stmt->num_rows > 0) {
    //         $stmt->bind_result($hashedPassword, $userType);
    //         $stmt->fetch();
            
    //         if (password_verify($password, $hashedPassword)) {
    //             // Start session and redirect user based on user type
    //             session_start();
    //             $_SESSION['user_type'] = $userType;
    //             $_SESSION['email'] = $email;
    //             header("Location: dashboard.php"); // Redirect to dashboard
    //         } else {
    //             echo "Invalid password.";
    //         }
    //     } else {
    //         echo "No user found with this email.";
    //     }

    //     $stmt->close();
    //     $conn->close();
    // }

    require '../../dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Protect against SQL Injection
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Query to check the credentials
        $sql = "SELECT * FROM users_acc WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password']; // Assuming password is hashed in the DB

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct
                echo 'success';
            } else {
                // Incorrect password
                echo 'error';
            }
        } else {
            // Email not found
            echo 'error';
        }
    }

    $conn->close();
?>
