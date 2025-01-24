<?php
require_once "../dbconn.php";

$baseUrl = '/AIMS/assets/uploads/comp-img/';
$defaultLogo = $baseUrl . 'asiatech-logo.png'; // Default logo image
$defaultBackground = $baseUrl . 'asiatech.png'; // Default background image

$query = "SELECT company, company_logo, company_image FROM users";
$result = $conn->query($query);

$response = ['success' => false, 'data' => []];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logo_path = trim($row['company_logo']);
        $background_path = trim($row['company_image']);

        // If the logo or background image is empty, use the default images
        if (empty($logo_path)) {
            $logo_path = $defaultLogo;
        } else {
            $logo_path = $baseUrl . basename($logo_path);
        }

        if (empty($background_path)) {
            $background_path = $defaultBackground;
        } else {
            $background_path = $baseUrl . basename($background_path);
        }

        $response['data'][] = [
            'company' => $row['company'],
            'company_logo' => $logo_path,
            'company_image' => $background_path,
        ];
    }
    $response['success'] = true;
}

$conn->close();

echo json_encode($response);
?>
