<?php
    include '../../dbconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $user_type = $_POST['user_type'];
    
        // SQL query template
        $query = "";
        $stmt = null;
    
        if ($user_type === 'Registrar') {
            // Check if there's already a Registrar in the database
            $checkQuery = "SELECT COUNT(*) as count FROM users_acc WHERE user_type = 'Registrar'";
            $checkResult = $conn->query($checkQuery);
            $row = $checkResult->fetch_assoc();
            
            if ($row['count'] > 0) {
                echo "Error: Only one Registrar is allowed.";
                exit();
            }
        }
    
        switch($user_type) {
            case 'OJT Student':
                $department = $_POST['department'];
                $studentID = $_POST['studentID'];
                $query = "INSERT INTO users_acc (firstname, lastname, department, studentID, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssssss", $firstname, $lastname, $department, $studentID, $email, $password, $user_type);
                break;
    
            case 'OJT Coordinator':
                $department = $_POST['department'];
                $company = $_POST['company'];
                $query = "INSERT INTO users_acc (firstname, lastname, department, company, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssssss", $firstname, $lastname, $department, $company, $email, $password, $user_type);
                break;
    
            case 'OJT Supervisor':
                $company = $_POST['company'];
                $query = "INSERT INTO users_acc (firstname, lastname, company, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssss", $firstname, $lastname, $company, $email, $password, $user_type);
                break;
    
            case 'Registrar':
                $query = "INSERT INTO users_acc (firstname, lastname, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssss", $firstname, $lastname, $email, $password, $user_type);
                break;
    
            default:
                echo "Invalid user type.";
                exit();
        }
    
        // Execute the query
        if ($stmt->execute()) {
            echo "New user added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request method.";
    }
?>