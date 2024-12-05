<?php
    session_start();

    // Set session timeout duration (in seconds)
    $inactive = 20;

    // Check if the session has expired
    if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout']) > $inactive) {
        session_unset();     // Unset session variables
        session_destroy();   // Destroy session
        echo json_encode(['sessionExpired' => true]); // Notify that session expired
        exit();
    }

    // Update session timeout
    $_SESSION['timeout'] = time(); // Reset the session timeout
    echo json_encode(['sessionExpired' => false]); // Notify that session is still active
?>
