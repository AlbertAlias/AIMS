<?php
include '../../../dbconn.php';

// Get dean's first and last name from the request
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];

// SQL query to fetch dean details and associated departments
$sql = "
    SELECT u.first_name, u.last_name, u.username, d.department_name
    FROM users u
    LEFT JOIN department d ON u.user_id = d.dean_id
    WHERE u.first_name = ? AND u.last_name = ? AND u.user_type = 'Dean'
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $first_name, $last_name);  // Bind the parameters
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the dean information
    $row = $result->fetch_assoc();

    // Prepare the response data
    $response = array(
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'username' => $row['username'],
        'departments' => []  // Initialize an empty array to store departments
    );

    // Fetch all department names associated with the dean
    do {
        $response['departments'][] = $row['department_name'];  // Add each department to the array
    } while ($row = $result->fetch_assoc());

    // Send JSON response
    echo json_encode($response);
} else {
    // If no result is found, send an error message
    echo json_encode(['error' => 'No dean found']);
}

$stmt->close();
$conn->close();
?>