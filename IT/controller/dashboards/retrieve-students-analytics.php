<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('../../../dbconn.php');

    // Query to count the number of students per department who have accounts
    $query = "
        SELECT 
            department.department_name, 
            COUNT(users.user_id) AS total 
        FROM 
            users 
        JOIN 
            department ON users.department_id = department.department_id
        WHERE 
            users.user_type = 'Student' 
        GROUP BY 
            users.department_id
    ";

    $result = $conn->query($query);

    // Check if the query failed
    if (!$result) {
        // If there's an error with the query, return an error message
        echo json_encode(['error' => 'Query failed: ' . $conn->error]);
        exit; // Exit after error to avoid further output
    }

    if ($result->num_rows > 0) {
        $studentData = [];
        while($row = $result->fetch_assoc()) {
            $studentData[] = [
                'department_name' => $row['department_name'],
                'total' => $row['total']
            ];
        }
        echo json_encode($studentData); // Return the data as JSON
    } else {
        echo json_encode(['error' => 'No data found']);
    }

    $conn->close();
?>