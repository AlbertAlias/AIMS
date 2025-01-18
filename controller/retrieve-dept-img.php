<?php
    require_once "../dbconn.php";

    $baseUrl = '/AIMS/assets/uploads/dept-img/';

    $query = "SELECT department_name, department_image FROM department";
    $result = $conn->query($query);

    $response = ['success' => false, 'data' => []];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $image_path = trim($row['department_image']);
            if (empty($image_path)) {
                $image_path = $baseUrl . 'placeholder.jpg'; 
            } else {
                $image_path = $baseUrl . basename($image_path);
            }

            $response['data'][] = [
                'department_name' => $row['department_name'],
                'department_image' => $image_path,
            ];
        }
        $response['success'] = true;
    }

    $conn->close();

    echo json_encode($response);
?>