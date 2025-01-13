<?php
// require_once "../../../dbconn.php";

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $department_name = trim($_POST['department_name'] ?? '');

//     if (empty($department_name)) {
//         echo json_encode(['success' => false, 'error' => 'Department name is required']);
//         exit;
//     }

//     $checkQuery = "SELECT 1 FROM department WHERE department_name = ?";
//     $stmt = $conn->prepare($checkQuery);
//     $stmt->bind_param("s", $department_name);
//     $stmt->execute();
//     $stmt->store_result();

//     if ($stmt->num_rows > 0) {
//         echo json_encode(['success' => false, 'error' => 'Department name already exists']);
//         exit;
//     }
//     $stmt->close();

//     // Handle file upload
//     $department_image = null;
//     if (isset($_FILES['department_image']) && $_FILES['department_image']['error'] === UPLOAD_ERR_OK) {
//         $uploadDir = '../../../uploads/';
//         $fileName = basename($_FILES['department_image']['name']);
//         $filePath = $uploadDir . $fileName;

//         // Move the file to the uploads directory
//         if (move_uploaded_file($_FILES['department_image']['tmp_name'], $filePath)) {
//             $department_image = 'uploads/' . $fileName; // Relative path to store in the database
//         } else {
//             echo json_encode(['success' => false, 'error' => 'Failed to upload the file.']);
//             exit;
//         }
//     }

//     $insertQuery = "INSERT INTO department (department_name, department_image) VALUES (?, ?)";
//     $stmt = $conn->prepare($insertQuery);
//     $stmt->bind_param("ss", $department_name, $department_image);

//     if ($stmt->execute()) {
//         echo json_encode(['success' => true]);
//     } else {
//         echo json_encode(['success' => false, 'error' => 'Failed to add department.']);
//     }

//     $stmt->close();
//     $conn->close();
// }
?>

<?php
require_once "../../../dbconn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $department_name = trim($_POST['department_name'] ?? '');

    if (empty($department_name)) {
        echo json_encode(['success' => false, 'error' => 'Department name is required']);
        exit;
    }

    $checkQuery = "SELECT 1 FROM department WHERE department_name = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $department_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Department name already exists']);
        exit;
    }
    $stmt->close();

    // Handle file upload
    $department_image = null;
    if (isset($_FILES['department_image']) && $_FILES['department_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../assets/uploads/dept-img/'; // Updated to match the file structure
        $fileName = basename($_FILES['department_image']['name']);
        $filePath = $uploadDir . $fileName;

        // Check if directory is writable
        if (!is_writable($uploadDir)) {
            echo json_encode(['success' => false, 'error' => 'Upload directory is not writable.']);
            exit;
        }

        // Move the file to the uploads directory
        if (move_uploaded_file($_FILES['department_image']['tmp_name'], $filePath)) {
            $department_image = 'uploads/dept-img/' . $fileName; // Relative path to store in the database
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to upload the file.']);
            exit;
        }
    }

    // Insert the department into the database
    $insertQuery = "INSERT INTO department (department_name, department_image) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $department_name, $department_image);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add department.']);
    }

    $stmt->close();
    $conn->close();
}
?>
