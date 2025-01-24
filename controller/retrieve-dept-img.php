<?php
    // require_once "../dbconn.php";

    // $baseUrl = '/AIMS/assets/uploads/dept-img/';

    // $query = "SELECT department_name, department_image FROM department";
    // $result = $conn->query($query);

    // $response = ['success' => false, 'data' => []];

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $image_path = trim($row['department_image']);
    //         if (empty($image_path)) {
    //             $image_path = $baseUrl . 'placeholder.png'; 
    //         } else {
    //             $image_path = $baseUrl . basename($image_path);
    //         }

    //         $response['data'][] = [
    //             'department_name' => $row['department_name'],
    //             'department_image' => $image_path,
    //         ];
    //     }
    //     $response['success'] = true;
    // }

    // $conn->close();

    // echo json_encode($response);
?>

<?php
require_once "../dbconn.php";

$baseUrl = '/AIMS/assets/uploads/dept-img/';
$response = ['success' => false, 'data' => []];

$query = "SELECT department_name, department_image FROM department";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $image_path = trim($row['department_image']);
        if (empty($image_path)) {
            $image_path = $baseUrl . 'placeholder.png';
        } else {
            $image_path = $baseUrl . basename($image_path);
        }

        $response['data'][] = [
            'department_name' => $row['department_name'],
            'department_image' => $image_path,
        ];
    }
    $response['success'] = true;
} else {
    // Add a placeholder if no departments are retrieved
    $response['data'][] = [
        'department_name' => 'No Departments Available',
        'department_image' => $baseUrl . 'placeholder.png',
    ];
    $response['success'] = true;
}

$conn->close();
echo json_encode($response);
?>
