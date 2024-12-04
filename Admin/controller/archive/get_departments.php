<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'aims_db'; // The database you are using
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

// Set response header to JSON
header('Content-Type: application/json');

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all departments from the 'departments' table
    $query = "SELECT id, department_name FROM departments";
    $stmt = $pdo->query($query);

    // Check if departments are found
    if ($stmt->rowCount() > 0) {
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Respond with the departments data
        echo json_encode([
            'status' => 'success',
            'departments' => $departments
        ]);
    } else {
        // If no departments are found
        echo json_encode([
            'status' => 'no_data',
            'message' => 'No departments found in the database.'
        ]);
    }

} catch (PDOException $e) {
    // Respond with error message in case of database connection issues
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>
