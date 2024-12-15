<?php
    require_once "../../../dbconn.php";

    // Check if we should exclude a specific department
    $exclude_department_id = isset($_GET['exclude_department_id']) ? (int)$_GET['exclude_department_id'] : null;

    // Fetch all departments
    $query = "
        SELECT department_id, department_name
        FROM department
        WHERE department_id NOT IN (
            SELECT DISTINCT department_id FROM users WHERE user_type = 'Coordinator'
        )";

    // Exclude a department if needed
    if ($exclude_department_id) {
        $query .= " AND department_id != $exclude_department_id";
    }

    $query .= " ORDER BY department_name ASC";

    $result = $conn->query($query);

    $departments = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[] = [
                "id" => $row['department_id'],
                "name" => $row['department_name']
            ];
        }
    }

    // Always return a valid success response, even if no data exists
    echo json_encode([
        'success' => true,
        'data' => $departments
    ]);

    $conn->close();
?>