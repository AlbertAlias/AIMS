<?php
require_once '../../../dbconn.php'; // Include your DB connection file

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']);
    $query = "SELECT * FROM admins WHERE id = ?";
    
    if ($stmt = $db->prepare($query)) {
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