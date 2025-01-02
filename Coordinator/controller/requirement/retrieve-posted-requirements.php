<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Update statuses of expired requirements
    $current_date = date('Y-m-d');
    $update_expired_query = "UPDATE requirements SET status = 'closed' WHERE deadline < ? AND status = 'open'";
    $stmt_update = $conn->prepare($update_expired_query);
    $stmt_update->bind_param("s", $current_date);
    $stmt_update->execute();

    // Retrieve updated requirements
    session_start();
    $coordinator_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM requirements WHERE coordinator_id = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coordinator_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = $row;
    }

    echo json_encode([
        'success' => true,
        'requirements' => $requirements
    ]);
?>
