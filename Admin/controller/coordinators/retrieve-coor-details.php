<?php
require_once '../../../dbconn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT id, first_name, last_name, middle_name, suffix, address, birthdate, personal_email, contact_number, gender, civil_status, account_email, password, department FROM coordinators WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $coordinator = $result->fetch_assoc();
        echo json_encode($coordinator);
    } else {
        echo json_encode(['error' => 'Coordinator not found']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>