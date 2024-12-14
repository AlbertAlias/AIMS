<?php
include('../../../dbconn.php');

// Fetch all departments
$sql = "SELECT department_id, department_name FROM department";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $departments = array();

    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }

    $response = array(
        'success' => true,
        'departments' => $departments
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'No departments found'
    );
}

$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
