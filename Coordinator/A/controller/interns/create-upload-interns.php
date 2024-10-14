<?php
    session_start();
    require_once '../../../../dbconn.php'; // Ensure correct path for database connection
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
        $allowedTypes = ['application/vnd.ms-excel', 
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
                        'text/csv'];

        // Check file type
        if (in_array($file['type'], $allowedTypes)) {
            // Move the uploaded file to a desired directory
            $uploadDir = 'uploads/'; // Adjust as needed
            $uploadFile = $uploadDir . basename(trim($file['name']));

            if (!is_dir($uploadDir)) {
                $response['message'] = 'Upload directory does not exist.';
            } elseif (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Read CSV file and insert into the database
                if ($file['type'] === 'text/csv') {
                    $handle = fopen($uploadFile, 'r');
                    if ($handle) {
                        // Skip the first line if it contains headers
                        fgetcsv($handle); 

                        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                            // Check if the required number of columns are present (should be 14)
                            if (count($data) < 14) { // Should be 14 for your case
                                throw new Exception("Insufficient data in CSV row.");
                            }

                            // Extract and sanitize data
                            $lastName = $conn->real_escape_string($data[0]);
                            $firstName = $conn->real_escape_string($data[1]);
                            $middleName = $conn->real_escape_string($data[2]);
                            $suffix = $conn->real_escape_string($data[3]);
                            $gender = $conn->real_escape_string($data[4]);
                            $address = $conn->real_escape_string($data[5]);
                            $birthdate = DateTime::createFromFormat('m/d/Y', $data[6])->format('Y-m-d');
                            $civilStatus = $conn->real_escape_string($data[7]);
                            $personalEmail = $conn->real_escape_string($data[8]);
                            $contactNumber = $conn->real_escape_string($data[9]);
                            $studentID = $conn->real_escape_string($data[10]);
                            $departmentName = $conn->real_escape_string($data[11]);
                            $accountEmail = $conn->real_escape_string($data[12]);
                            $password = password_hash($conn->real_escape_string($data[13]), PASSWORD_BCRYPT); // Hash the password
                            
                            // Validate department name
                            if (empty($departmentName)) {
                                throw new Exception("Department name is missing.");
                            }

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
                                                    '$departmentId', '$accountEmail', '$password', 'intern')"; // Removed studentID
                                
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
                        fclose($handle);
                    }
                }

                $response['success'] = true;
                $response['message'] = 'File uploaded and processed successfully.';
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