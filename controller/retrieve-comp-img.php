<?php
require '../dbconn.php';

$basePath = '/AIMS/assets/uploads/comp-img/';
$defaultBackground = '/AIMS/assets/uploads/comp-img/asiatech.png';  // Path to the default background image

$sql = "SELECT company, company_logo, company_image 
        FROM users 
        WHERE company_logo IS NOT NULL OR company_image IS NOT NULL 
        GROUP BY company";

$result = $conn->query($sql);

$companies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logo = trim($row['company_logo']);
        $background = trim($row['company_image']);

        // If no company logo or image, set default values
        $logoPath = !empty($logo) ? $basePath . $logo : null;
        $backgroundPath = !empty($background) ? $basePath . $background : $defaultBackground;

        $companies[] = [
            'logo' => $logoPath,
            'background' => $backgroundPath
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($companies);
?>