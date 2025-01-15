<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../../../dbconn.php');

    $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';

$query = "
    SELECT u.user_id, u.first_name, u.last_name, 
    GROUP_CONCAT(d.department_name ORDER BY d.department_name SEPARATOR ', ') AS departments
    FROM users u
    LEFT JOIN dean_department dd ON u.user_id = dd.dean_id
    LEFT JOIN department d ON dd.department_id = d.department_id
    WHERE u.user_type = 'Dean' AND dd.department_id IS NOT NULL
";

if ($search) {
    $query .= " AND (u.first_name LIKE ? OR u.last_name LIKE ? OR d.department_name LIKE ?)";
}

$query .= " GROUP BY u.user_id";

$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to prepare the query.'
    ]);
    exit;
}

if ($search) {
    $stmt->bind_param("sss", $search, $search, $search);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $deans = [];
    while ($row = $result->fetch_assoc()) {
        $deans[] = [
            'user_id' => $row['user_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'departments' => $row['departments']
        ];
    }

    echo json_encode([
        'success' => true,
        'deans' => $deans
    ]);
} else {
    echo json_encode([
        'success' => true,
        'deans' => []
    ]);
}

$stmt->close();
$conn->close();
?>
