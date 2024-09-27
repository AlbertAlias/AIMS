<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../dbconn.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']);
    $query = "SELECT id, last_name, first_name, middle_name, suffix, gender, address, birthdate, civil_status, contact_number, personal_email, account_email, password, role FROM admins WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin) {
            echo json_encode($admin);
        } else {
            echo json_encode(['error' => 'Admin not found.']);
        }
    } else {
        echo json_encode(['error' => 'Database query failed.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
