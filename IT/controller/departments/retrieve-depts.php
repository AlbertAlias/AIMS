<?php
require_once "../../../dbconn.php"; // Include the database connection file

// Fetch all departments that are NOT handled by any Dean
$query = "
    SELECT department.department_id, department.department_name
    FROM department
    LEFT JOIN dean_department ON department.department_id = dean_department.department_id
    WHERE dean_department.dean_id IS NULL
    ORDER BY department.department_name ASC
";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = [
            "id" => $row['department_id'],
            "name" => $row['department_name']
        ];
    }
    echo json_encode(['success' => true, 'data' => $departments]);
} else {
    // Debugging output
    $error_msg = "No departments found or an issue with the query.";
    if ($conn->error) {
        $error_msg .= " MySQL error: " . $conn->error;
    }
    echo json_encode(['success' => false, 'error' => $error_msg]);
}

$conn->close();
?>