<?php
    // require_once '../../../dbconn.php';
    // header('Content-Type: application/json');

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $last_name = $conn->real_escape_string(trim($_POST['visor_last_name']));
    //     $first_name = $conn->real_escape_string(trim($_POST['visor_first_name']));
    //     $middle_name = $conn->real_escape_string(trim($_POST['visor_middle_name'] ?? ''));
    //     $gender = $conn->real_escape_string(trim($_POST['visor_gender']));
    //     $email = $conn->real_escape_string(trim($_POST['visor_personal_email']));
    //     $company = $conn->real_escape_string(trim($_POST['visor_company_name']));
    //     $company_address = $conn->real_escape_string(trim($_POST['visor_company_address']));
    //     $username = $conn->real_escape_string(trim($_POST['visor_username']));
    //     $password = password_hash(trim($_POST['visor_password']), PASSWORD_BCRYPT);

    //     if (empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || empty($company_address) || empty($username) || empty($password)) {
    //         echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    //         exit;
    //     }

    //     $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
    //     $checkResult = $conn->query($checkQuery);

    //     if ($checkResult->num_rows > 0) {
    //         echo json_encode(['success' => false, 'message' => 'Username already exists. Please choose another.']);
    //         exit;
    //     }

    //     $query = "INSERT INTO users (last_name, first_name, middle_name, gender, email, company, company_address, username, password, user_type) 
    //             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Supervisor')";
    //     $stmt = $conn->prepare($query);
    //     $stmt->bind_param("sssssssss", $last_name, $first_name, $middle_name, $gender, $email, $company, $company_address, $username, $password);

    //     if ($stmt->execute()) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    //     }

    //     $stmt->close();
    // }

    // $conn->close();
?>

<?php
    require_once '../../../dbconn.php';
    
    // Enable error reporting temporarily to catch any issues
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    // Define the maximum allowed file size (40MB in bytes)
    define('MAX_FILE_SIZE', 40 * 1024 * 1024);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if form fields exist and sanitize input
        $last_name = isset($_POST['visor_last_name']) ? $conn->real_escape_string(trim($_POST['visor_last_name'])) : '';
        $first_name = isset($_POST['visor_first_name']) ? $conn->real_escape_string(trim($_POST['visor_first_name'])) : '';
        $middle_name = isset($_POST['visor_middle_name']) ? $conn->real_escape_string(trim($_POST['visor_middle_name'])) : '';
        $gender = isset($_POST['visor_gender']) ? $conn->real_escape_string(trim($_POST['visor_gender'])) : '';
        $email = isset($_POST['visor_personal_email']) ? $conn->real_escape_string(trim($_POST['visor_personal_email'])) : '';
        $company = isset($_POST['visor_company_name']) ? $conn->real_escape_string(trim($_POST['visor_company_name'])) : '';
        $company_address = isset($_POST['visor_company_address']) ? $conn->real_escape_string(trim($_POST['visor_company_address'])) : '';
        $username = isset($_POST['visor_username']) ? $conn->real_escape_string(trim($_POST['visor_username'])) : '';
        $password = isset($_POST['visor_password']) ? password_hash(trim($_POST['visor_password']), PASSWORD_BCRYPT) : '';

        // Check if required fields are empty
        if (empty($last_name) || empty($first_name) || empty($gender) || empty($email) || empty($company) || empty($company_address) || empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
            exit;
        }

        // Check if files are uploaded
        $company_logo = isset($_FILES['company_logo']) ? $_FILES['company_logo'] : null;
        $company_image = isset($_FILES['company_image']) ? $_FILES['company_image'] : null;

        // Check for file upload errors
        if ($company_logo && $company_logo['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'Error uploading company logo.']);
            exit;
        }

        if ($company_image && $company_image['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'Error uploading company image.']);
            exit;
        }

        // Check if file sizes are within the limit
        if ($company_logo && $company_logo['size'] > MAX_FILE_SIZE) {
            echo json_encode(['success' => false, 'message' => 'Company logo file size exceeds the limit of 40MB.']);
            exit;
        }

        if ($company_image && $company_image['size'] > MAX_FILE_SIZE) {
            echo json_encode(['success' => false, 'message' => 'Company image file size exceeds the limit of 40MB.']);
            exit;
        }

        // Set the upload directory
        $upload_dir = '../../../assets/uploads/comp-img/';

        // Use original file names instead of generating unique names
        $logo_filename = $company_logo ? basename($company_logo['name']) : null;
        $image_filename = $company_image ? basename($company_image['name']) : null;

        // Attempt to move the uploaded files to the server
        if ($company_logo && !move_uploaded_file($company_logo['tmp_name'], $upload_dir . $logo_filename)) {
            echo json_encode(['success' => false, 'message' => 'Failed to upload company logo.']);
            exit;
        }

        if ($company_image && !move_uploaded_file($company_image['tmp_name'], $upload_dir . $image_filename)) {
            echo json_encode(['success' => false, 'message' => 'Failed to upload company image.']);
            exit;
        }

        $checkQuery = "SELECT user_id FROM users WHERE username = '$username'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists. Please choose another.']);
            exit;
        }

        // SQL Query to insert the supervisor data
        $query = "INSERT INTO users (last_name, first_name, middle_name, gender, email, company, company_address, username, password, company_image, company_logo)
                  VALUES ('$last_name', '$first_name', '$middle_name', '$gender', '$email', '$company', '$company_address', '$username', '$password', '$image_filename', '$logo_filename')";

        if ($conn->query($query) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Supervisor added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
?>
