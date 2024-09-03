<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }

    // Connect to your database
    include('../../dbconn.php'); // Ensure you have this file to connect to your database

    $email = $_SESSION['email'];
    $query = "SELECT firstname, lastname, email, user_type FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
?>

<div class="container">
    <h1 class="my-4">Profile Information</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($admin['firstname']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($admin['lastname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
            <p><strong>User Type:</strong> <?php echo htmlspecialchars($admin['user_type']); ?></p>
        </div>
    </div>
</div>