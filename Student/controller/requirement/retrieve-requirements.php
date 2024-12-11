<?php
    session_start();  // Start the session to access session variables

    // Ensure the user is logged in and is a coordinator
    if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'Coordinator') {
        // Get the coordinator ID from the session
        $coordinatorId = $_SESSION['user_id'];

        // Include database connection
        include('../../../dbconn.php');

        // Prepare SQL query to fetch pending requirements
        $sql = "
            SELECT r.requirement_id, r.title, r.description 
            FROM requirements r
            LEFT JOIN submit_requirements sr ON r.requirement_id = sr.requirement_id
            WHERE r.coordinator_id = ? 
            AND (sr.submit_id IS NULL OR sr.status != 'approved') 
            AND r.status = 'pending';
        ";

        // Prepare and execute the query
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $coordinatorId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if we have results
            if ($result->num_rows > 0) {
                $requirements = [];
                while ($row = $result->fetch_assoc()) {
                    $requirements[] = $row;
                }
                // Return the results as a JSON response
                echo json_encode(['requirements' => $requirements]);
            } else {
                echo json_encode(['requirements' => []]);  // Send an empty array if no data found
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Failed to prepare SQL query']);
        }

        $conn->close();
    } else {
        // If not logged in or not a coordinator, return an error
        echo json_encode(['error' => 'Not logged in or not a coordinator']);
    }
?>