<?php
    include('../../../dbconn.php'); // Database connection

    // Check if department_name is set
    if (isset($_GET['department_name'])) {
        $department_name = $_GET['department_name'];

        // Prepare SQL query to retrieve department details
        $stmt = $conn->prepare("SELECT department_id, department_name FROM department WHERE department_name = ?");
        $stmt->bind_param("s", $department_name);
        $stmt->execute();
        $stmt->store_result();

        // Check if department exists
        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($department_id, $department_name);
            $stmt->fetch();

            // Return department details as JSON
            echo json_encode(['success' => true, 'department_id' => $department_id, 'department_name' => $department_name]);
        } else {
            // Return error if department is not found
            echo json_encode(['success' => false]);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Return error if department_name is not provided
        echo json_encode(['success' => false]);
    }
?>
