<?php
include '../../../dbconn.php'; // Include database connection

if (isset($_GET['id'])) {
    // Retrieve specific coordinator details based on the ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM coordinators WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $coordinator = mysqli_fetch_assoc($result);
        // Return the result as JSON
        echo json_encode(['success' => true, 'data' => $coordinator]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }
} else {
    // Retrieve all coordinators
    $query = "SELECT id, first_name, last_name FROM coordinators";
    $result = mysqli_query($conn, $query);

    $coordinators = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $coordinators[] = $row;
        }
    }

    // Return the results as JSON
    echo json_encode($coordinators);
}

// Close the connection
mysqli_close($conn);
?>