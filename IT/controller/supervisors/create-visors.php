<?php
    require_once '../../../dbconn.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    define('MAX_FILE_SIZE', 40 * 1024 * 1024);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $last_name = isset($_POST['visor_last_name']) ? $conn->real_escape_string(trim($_POST['visor_last_name'])) : '';
        $first_name = isset($_POST['visor_first_name']) ? $conn->real_escape_string(trim($_POST['visor_first_name'])) : '';
        $middle_name = isset($_POST['visor_middle_name']) ? $conn->real_escape_string(trim($_POST['visor_middle_name'])) : '';
        $gender = isset($_POST['visor_gender']) ? $conn->real_escape_string(trim($_POST['visor_gender'])) : '';
        $email = isset($_POST['visor_personal_email']) ? $conn->real_escape_string(trim($_POST['visor_personal_email'])) : '';
        $company = isset($_POST['visor_company_name']) ? $conn->real_escape_string(trim($_POST['visor_company_name'])) : '';
        $company_address = isset($_POST['visor_company_address']) ? $conn->real_escape_string(trim($_POST['visor_company_address'])) : '';
        $username = isset($_POST['visor_username']) ? $conn->real_escape_string(trim($_POST['visor_username'])) : '';
        $password = isset($_POST['visor_password']) ? password_hash(trim($_POST['visor_password']), PASSWORD_BCRYPT) : '';

        if (empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || empty($company_address) || empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
            exit;
        }

        $company_logo = isset($_FILES['company_logo']) ? $_FILES['company_logo'] : null;
        $company_image = isset($_FILES['company_image']) ? $_FILES['company_image'] : null;

        if ($company_logo && $company_logo['size'] > MAX_FILE_SIZE) {
            echo json_encode(['success' => false, 'message' => 'Company logo file size exceeds the limit of 40MB.']);
            exit;
        }

        if ($company_image && $company_image['size'] > MAX_FILE_SIZE) {
            echo json_encode(['success' => false, 'message' => 'Company image file size exceeds the limit of 40MB.']);
            exit;
        }

        $upload_dir = '../../../assets/uploads/comp-img/';

        $logo_filename = $company_logo ? basename($company_logo['name']) : null;
        $image_filename = $company_image ? basename($company_image['name']) : null;

        if ($company_logo) {
            $logo_target_path = $upload_dir . $logo_filename;
            if (!move_uploaded_file($company_logo['tmp_name'], $logo_target_path)) {
                echo json_encode(['success' => false, 'message' => 'Failed to upload the company logo.']);
                exit;
            }
        }

        if ($company_image) {
            $image_target_path = $upload_dir . $image_filename;
            if (!move_uploaded_file($company_image['tmp_name'], $image_target_path)) {
                echo json_encode(['success' => false, 'message' => 'Failed to upload the company image.']);
                exit;
            }
        }

        $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists. Please choose another.']);
            exit;
        }

        $query = "INSERT INTO users (last_name, first_name, middle_name, gender, email, company, company_address, username, password, company_image, company_logo, user_type)
                VALUES ('$last_name', '$first_name', '$middle_name', '$gender', '$email', '$company', '$company_address', '$username', '$password', '$image_filename', '$logo_filename', 'Supervisor')";

        if ($conn->query($query) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Supervisor added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>
