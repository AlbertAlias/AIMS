<?php
session_start();
require_once '../../../../dbconn.php';
require '../../../../libraries/PhpSpreadsheet-3.3.0/src/PhpSpreadsheet/IOFactory.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

ini_set('display_errors', 0);
error_reporting(0);

$response = ['success' => false, 'message' => ''];

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    $response['message'] = 'User not authenticated.';
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']; // Only XLSX supported

    // Check file type
    if (in_array($file['type'], $allowedTypes)) {
        // Move the uploaded file to a desired directory
        $uploadDir = 'uploads/'; // Adjust as needed
        $uploadFile = $uploadDir . basename(trim($file['name']));

        if (!is_dir($uploadDir)) {
            $response['message'] = 'Upload directory does not exist.';
        } elseif (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            // Load the Excel file using PhpSpreadsheet
            try {
                $spreadsheet = IOFactory::load($uploadFile);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                // Skip the first row if it contains headers
                array_shift($rows);

                foreach ($rows as $row) {
                    // Check if the required number of columns are present (should be 14)
                    if (count($row) < 14) {
                        throw new Exception("Insufficient data in Excel row.");
                    }

                    // Extract and sanitize data
                    $lastName = $conn->real_escape_string($row[0]);
                    $firstName = $conn->real_escape_string($row[1]);
                    $middleName = $conn->real_escape_string($row[2]);
                    $suffix = $conn->real_escape_string($row[3]);
                    $gender = $conn->real_escape_string($row[4]);
                    $address = $conn->real_escape_string($row[5]);
                    $birthdate = DateTime::createFromFormat('m/d/Y', $row[6])->format('Y-m-d');
                    $civilStatus = $conn->real_escape_string($row[7]);
                    $personalEmail = $conn->real_escape_string($row[8]);
                    $contactNumber = $conn->real_escape_string($row[9]);
                    $studentID = $conn->real_escape_string($row[10]);
                    $departmentName = $conn->real_escape_string($row[11]);
                    $accountEmail = $conn->real_escape_string($row[12]);
                    $password = password_hash($conn->real_escape_string($row[13]), PASSWORD_BCRYPT); // Hash the password

                    // Validate required fields
                    if (empty($lastName) || empty($firstName) || empty($address) || 
                        empty($personalEmail) || empty($contactNumber) || 
                        empty($accountEmail) || empty($password)) {
                        throw new Exception("Required user data is missing or invalid.");
                    }

                    // Validate department name
                    if (empty($departmentName)) {
                        throw new Exception("Department name is missing.");
                    }

                    // Check for existing email
                    $emailCheck = $conn->query("SELECT id FROM users WHERE account_email = '$accountEmail'");
                    if ($emailCheck->num_rows > 0) {
                        throw new Exception("Account email '$accountEmail' already exists.");
                    }

                    // Get department ID
                    $departmentIdResult = $conn->query("SELECT id FROM departments WHERE department_name = '$departmentName'");
                    if ($departmentIdResult->num_rows > 0) {
                        $row = $departmentIdResult->fetch_assoc();
                        $departmentId = $row['id']; // Get the department ID
                    } else {
                        throw new Exception("Invalid department name: $departmentName. No matching department found.");
                    }

                    // Start a transaction to ensure data integrity
                    $conn->begin_transaction();
                    try {
                        // Insert into users table with user_type set to 'intern'
                        $sqlUser = "INSERT INTO users (last_name, first_name, middle_name, suffix, gender, address, birthdate, 
                                                        civil_status, personal_email, contact_number, department_id, 
                                                        account_email, password, user_type)
                                    VALUES ('$lastName', '$firstName', '$middleName', '$suffix', '$gender', '$address', 
                                            '$birthdate', '$civilStatus', '$personalEmail', '$contactNumber', 
                                            '$departmentId', '$accountEmail', '$password', 'intern')";

                        if ($conn->query($sqlUser) === TRUE) {
                            $userId = $conn->insert_id; // Get the inserted user's ID

                            // Insert the file upload record into the file_uploads table
                            $sqlUpload = "INSERT INTO file_uploads (user_id, file_name, file_path) VALUES ('$userId', '{$file['name']}', '$uploadFile')";
                            
                            if ($conn->query($sqlUpload) === FALSE) {
                                throw new Exception("Failed to log file upload: " . $conn->error);
                            }

                            // Insert into interns table
                            $sqlIntern = "INSERT INTO interns (user_id, studentID) VALUES ('$userId', '$studentID')";
                            if ($conn->query($sqlIntern) === FALSE) {
                                throw new Exception("Failed to insert intern: " . $conn->error);
                            }
                        } else {
                            throw new Exception("Failed to insert user: " . $conn->error);
                        }

                        // Commit the transaction
                        $conn->commit();
                    } catch (Exception $e) {
                        $conn->rollback(); // Rollback on error
                        $response['message'] = $e->getMessage();
                        echo json_encode($response);
                        exit();
                    }
                }

                $response['success'] = true;
                $response['message'] = 'File uploaded and processed successfully.';
            } catch (Exception $e) {
                $response['message'] = 'Error processing the file: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'File upload failed.';
        }
    } else {
        $response['message'] = 'Invalid file type.';
    }
} else {
    $response['message'] = 'No file uploaded.';
}

echo json_encode($response);
?>