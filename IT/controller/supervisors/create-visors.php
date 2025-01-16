<?php
require_once '../../../dbconn.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture all input data
    $last_name = isset($_POST['visor_last_name']) ? $conn->real_escape_string(trim($_POST['visor_last_name'])) : '';
    $first_name = isset($_POST['visor_first_name']) ? $conn->real_escape_string(trim($_POST['visor_first_name'])) : '';
    $middle_name = isset($_POST['visor_middle_name']) ? $conn->real_escape_string(trim($_POST['visor_middle_name'])) : '';
    $gender = isset($_POST['visor_gender']) ? $conn->real_escape_string(trim($_POST['visor_gender'])) : '';
    $email = isset($_POST['visor_personal_email']) ? $conn->real_escape_string(trim($_POST['visor_personal_email'])) : '';
    $company = isset($_POST['visor_company_name']) ? $conn->real_escape_string(trim($_POST['visor_company_name'])) : '';
    $company_address = isset($_POST['visor_company_address']) ? $conn->real_escape_string(trim($_POST['visor_company_address'])) : '';
    $username = isset($_POST['visor_username']) ? $conn->real_escape_string(trim($_POST['visor_username'])) : '';
    $password = isset($_POST['visor_password']) ? password_hash(trim($_POST['visor_password']), PASSWORD_BCRYPT) : '';

    // File upload logic
    $uploadDir = '../../../assets/uploads/comp-img/';
    $companyImagePath = null;
    $companyLogoPath = null;

    // File validation and upload for company image
    if (isset($_FILES['visor_company_image']) && $_FILES['visor_company_image']['error'] === UPLOAD_ERR_OK) {
        $companyImagePath = $uploadDir . basename($_FILES['visor_company_image']['name']);
        if (!move_uploaded_file($_FILES['visor_company_image']['tmp_name'], $companyImagePath)) {
            $response['message'] = 'Failed to upload company image.';
            echo json_encode($response);
            exit;
        }
    } else {
        $response['message'] = 'Company image upload failed or not provided.';
        echo json_encode($response);
        exit;
    }

    // File validation and upload for company logo
    if (isset($_FILES['visor_company_logo']) && $_FILES['visor_company_logo']['error'] === UPLOAD_ERR_OK) {
        $companyLogoPath = $uploadDir . basename($_FILES['visor_company_logo']['name']);
        if (!move_uploaded_file($_FILES['visor_company_logo']['tmp_name'], $companyLogoPath)) {
            $response['message'] = 'Failed to upload company logo.';
            echo json_encode($response);
            exit;
        }
    } else {
        $response['message'] = 'Company logo upload failed or not provided.';
        echo json_encode($response);
        exit;
    }

    // Validate required fields
    if (empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || empty($company_address) || empty($username) || empty($password)) {
        $response['message'] = 'Please fill in all required fields.';
        echo json_encode($response);
        exit;
    }

    // Check if username already exists in the database
    $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $response['message'] = 'Username already exists. Please choose another.';
        echo json_encode($response);
        exit;
    }

    // Insert the new supervisor into the database
    $query = "INSERT INTO users (last_name, first_name, middle_name, gender, email, company, company_address, username, password, user_type, company_image, company_logo) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Supervisor', ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['message'] = 'Database query preparation failed.';
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("sssssssssss", $last_name, $first_name, $middle_name, $gender, $email, $company, $company_address, $username, $password, $companyImagePath, $companyLogoPath);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Error executing query: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>