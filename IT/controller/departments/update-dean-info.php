<?php
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $updatedData = $_POST['updatedData'];

    $updateFields = [];
    $params = [];
    $types = '';

    foreach ($updatedData as $field => $value) {
        if ($field == 'password') {
            $value = password_hash($value, PASSWORD_BCRYPT); // Hash passwords
        }
        $updateFields[] = "$field = ?";
        $params[] = $value;
        $types .= 's';
    }

    $params[] = $user_id;
    $types .= 'i';

    $sql = "UPDATE users SET " . implode(', ', $updateFields) . " WHERE user_id = ? AND user_type = 'Dean'";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>