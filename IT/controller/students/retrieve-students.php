<?php
    include('../../../dbconn.php');

    // Get the search term from the query string (if provided)
    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

    // SQL Query to get students' information with optional department name, first name, or last name filtering
    $sql = "SELECT u.user_id, u.last_name, u.first_name, d.department_name
            FROM users u
            JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Student'";

    // Apply filter if search term is provided
    if ($searchTerm) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql .= " AND (d.department_name LIKE '%" . $searchTerm . "%' 
                      OR u.first_name LIKE '%" . $searchTerm . "%' 
                      OR u.last_name LIKE '%" . $searchTerm . "%')";
    }

    $result = $conn->query($sql);

    $response = ['success' => true, 'students' => []]; // Default: no students, but success is true
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student = [
                'id' => $row['user_id'],
                'last_name' => $row['last_name'],
                'first_name' => $row['first_name'],
                'department_name' => $row['department_name']
            ];
            $response['students'][] = $student;
        }
    }
    $conn->close();
    echo json_encode($response);
?>