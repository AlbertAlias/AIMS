<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    if (isset($_GET['dept_id'])) {
        $dept_id = intval($_GET['dept_id']);

        // Adjusted SQL query to filter by user_type 'dean'
        $sql = "SELECT 
                    dept_dean.id AS id, 
                    dept_dean.department_name, 
                    users.last_name, 
                    users.first_name, 
                    users.username
                FROM department_dean dept_dean
                INNER JOIN users ON dept_dean.user_id = users.id
                WHERE dept_dean.id = ? AND users.user_type = 'dean'"; // Filter by dean user_type

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $dept_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'dean' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No dean found for the specified department.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'No department ID provided.']);
    }

    $conn->close();
?>
