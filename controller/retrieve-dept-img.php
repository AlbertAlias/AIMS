<?php
    require_once "../dbconn.php";

    // Base URL for the images folder
    $baseUrl = '/AIMS/assets/uploads/dept-img/';

    $query = "SELECT department_name, department_image FROM department";
    $result = $conn->query($query);

    // Prepare the response array
    $response = ['success' => false, 'data' => []];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Handle cases where department_image is NULL or empty
            $image_path = trim($row['department_image']);
            if (empty($image_path)) {
                // Set a default placeholder image if none exists
                $image_path = $baseUrl . 'placeholder.jpg'; 
            } else {
                // Ensure the image path is correctly constructed
                $image_path = $baseUrl . basename($image_path);
            }

            $response['data'][] = [
                'department_name' => $row['department_name'],
                'department_image' => $image_path,
            ];
        }
        $response['success'] = true;
    }

    // Close the connection
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
?>