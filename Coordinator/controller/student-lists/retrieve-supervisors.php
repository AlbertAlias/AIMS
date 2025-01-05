<?php
include '../../../dbconn.php';

try {
    if (isset($_GET['company'])) {
        $company = $_GET['company'];

        // Query to get all supervisors for the selected company
        $sql = "SELECT user_id, first_name, last_name FROM users WHERE user_type = 'Supervisor' AND company = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $company);  // Bind the company parameter
        $stmt->execute();
        $result = $stmt->get_result();

        $supervisors = [];
        while ($row = $result->fetch_assoc()) {
            $supervisors[] = $row;
        }

        // Return as JSON
        echo json_encode(['supervisors' => $supervisors]);
    } else {
        echo json_encode(['error' => 'Company parameter is missing']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$stmt->close();
$conn->close();
?>