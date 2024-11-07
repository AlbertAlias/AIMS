<?php
// Include the database connection
include('../../../dbconn.php');

// Get the data sent via AJAX
$adminId = $_POST['adminId']; // Assuming you pass the admin ID
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
$middleName = isset($_POST['middleName']) ? $_POST['middleName'] : null;
$location = isset($_POST['location']) ? $_POST['location'] : null;
$civilStatus = isset($_POST['civilStatus']) ? $_POST['civilStatus'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

$updateFields = [];
$params = [];

if ($lastName !== null) {
    $updateFields[] = "last_name = ?";
    $params[] = $lastName;
}

if ($firstName !== null) {
    $updateFields[] = "first_name = ?";
    $params[] = $firstName;
}

if ($middleName !== null) {
    $updateFields[] = "middle_name = ?";
    $params[] = $middleName;
}

if ($location !== null) {
    $updateFields[] = "address = ?";
    $params[] = $location;
}

if ($civilStatus !== null) {
    $updateFields[] = "civil_status = ?";
    $params[] = $civilStatus;
}

if ($email !== null) {
    $updateFields[] = "personal_email = ?";
    $params[] = $email;
}

if (empty($updateFields)) {
    echo json_encode(['error' => 'No changes to update']);
    exit;
}

// Prepare the SQL update query
$query = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = ?";
$params[] = $adminId; // Append the user ID at the end
$types = str_repeat('s', count($params)); // Assuming all fields are strings, adjust if needed

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Profile updated successfully']);
} else {
    echo json_encode(['error' => 'Failed to update profile']);
}

$stmt->close();
$conn->close();
?>
