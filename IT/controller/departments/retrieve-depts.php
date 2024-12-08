<?php
require_once '../../../dbconn.php';

$query = "SELECT id, department_name FROM departments ORDER BY department_name ASC";
$result = $conn->query($query);

$departments = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
    
    // Send the response as JSON
    echo json_encode(array(
        'status' => 'success',
        'departments' => $departments
    ));
} else {
    // Send error response if query fails
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Failed to retrieve departments.'
    ));
}

$conn->close();
?>
