<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../../../dbconn.php');

    // Get dean_id from the request
    $dean_id = isset($_GET['dean_id']) ? intval($_GET['dean_id']) : 0;

    // Validate dean_id
    if ($dean_id <= 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid dean ID.'
        ]);
        exit;
    }

    // Query to get dean's details (first name, last name, username, and associated departments)
    $query = "
        SELECT u.user_id, u.first_name, u.last_name, u.username,
            GROUP_CONCAT(d.department_name ORDER BY d.department_name SEPARATOR ', ') AS departments
        FROM users u
        LEFT JOIN dean_department dd ON u.user_id = dd.dean_id
        LEFT JOIN department d ON dd.department_id = d.department_id
        WHERE u.user_id = ? AND u.user_type = 'Dean'
        GROUP BY u.user_id
    ";

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare the query.'
        ]);
        exit;
    }

    // Bind the dean_id parameter
    $stmt->bind_param('i', $dean_id);

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any result is found
    if ($result->num_rows > 0) {
        $dean = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'dean' => [
                'first_name' => $dean['first_name'],
                'last_name' => $dean['last_name'],
                'username' => $dean['username'],
                'departments' => $dean['departments']  // Comma-separated departments
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Dean not found or no departments assigned.'
        ]);
    }

    $stmt->close();
    $conn->close();
?>