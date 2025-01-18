<?php
require '../dbconn.php'; // Ensure correct database connection

// Define the base URL for images
$basePath = '/AIMS/assets/uploads/comp-img/';

// Query to retrieve company details
$sql = "SELECT company, company_logo, company_image 
        FROM users 
        WHERE company_logo IS NOT NULL AND company_image IS NOT NULL 
        GROUP BY company";

$result = $conn->query($sql);

$companies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logo = trim($row['company_logo']); // Filename of the logo
        $background = trim($row['company_image']); // Filename of the background

        // Construct the full paths
        $logoPath = !empty($logo) ? $basePath . $logo : null;
        $backgroundPath = !empty($background) ? $basePath . $background : null;

        $companies[] = [
            'logo' => $logoPath,
            'background' => $backgroundPath
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($companies);
?>