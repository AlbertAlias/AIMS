<?php
    // include '../../../dbconn.php';

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // $departmentId = isset($_POST['department_id']) ? $_POST['department_id'] : null;
    // $departmentName = isset($_POST['department_name']) ? $_POST['department_name'] : null;

    // if ($departmentId && $departmentName) {
    //     $sql = "UPDATE department SET department_name = ? WHERE department_id = ?";

    //     $stmt = $conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("si", $departmentName, $departmentId);

    //         if ($stmt->execute()) {
    //             echo json_encode(['success' => true, 'message' => 'Department updated successfully']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Error executing the query: ' . $stmt->error]);
    //         }
    //         $stmt->close();
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Error preparing SQL statement']);
    //     }
    // } else {
    //     echo json_encode(['success' => false, 'message' => 'Invalid input']);
    // }

    // $conn->close();
?>

<?php
    include '../../../dbconn.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $departmentId = isset($_POST['department_id']) ? $_POST['department_id'] : null;
    $departmentName = isset($_POST['department_name']) ? $_POST['department_name'] : null;

    $targetDir = "../../../assets/uploads/dept-img/"; 
    $departmentImage = null;

    // Handle file upload
    if (isset($_FILES['department_image']) && $_FILES['department_image']['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['department_image']['name']);
        $targetFilePath = $targetDir . $fileName;
    
        // Ensure the upload directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
    
        // Move the uploaded file
        if (move_uploaded_file($_FILES['department_image']['tmp_name'], $targetFilePath)) {
            $departmentImage = 'uploads/dept-img/' . $fileName; // Save relative path
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading the file']);
            exit;
        }
    }
    
    if ($departmentId && $departmentName) {
        $sql = "UPDATE department SET department_name = ?";
        if ($departmentImage) {
            $sql .= ", department_image = ?";
        }
        $sql .= " WHERE department_id = ?";
    
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            if ($departmentImage) {
                $stmt->bind_param("ssi", $departmentName, $departmentImage, $departmentId);
            } else {
                $stmt->bind_param("si", $departmentName, $departmentId);
            }
    
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Department updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error executing the query: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error preparing SQL statement']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }

    $conn->close();
?>
