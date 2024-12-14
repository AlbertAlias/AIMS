<?php
include '../../../dbconn.php';

try {
    // Fetch distinct companies where the user type is 'Supervisor'
    $sql = "SELECT DISTINCT company FROM users WHERE user_type = 'Supervisor' AND company IS NOT NULL";
    $result = $conn->query($sql);

    $companies = [];
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row;
    }

    // Return as JSON
    echo json_encode(['companies' => $companies]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>
