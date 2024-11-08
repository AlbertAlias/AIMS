<?php
include '../../../dbconn.php';

// Decode the incoming JSON request
$request = json_decode(file_get_contents("php://input"));
$user_id = $request->user_id ?? null;
$password = $request->password ?? null;
$new_password = $request->new_password ?? null;
$new_location = $request->new_location ?? null;
$new_civil_status = $request->new_civil_status ?? null; // New field for civil status

if ($user_id) {
    // Update the user's location if provided
    if ($new_location !== null) {
        $stmt = $conn->prepare("UPDATE users SET address = ? WHERE id = ?");
        $stmt->bind_param("si", $new_location, $user_id);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update location"]);
        }
        $stmt->close();
    }
    // Update civil status if provided
    elseif ($new_civil_status !== null) {
        $stmt = $conn->prepare("UPDATE users SET civil_status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_civil_status, $user_id);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update civil status"]);
        }
        $stmt->close();
    }
    // Verify password if provided
    elseif ($password !== null) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($password, $hashed_password)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password"]);
        }
    }
    // Update password if new password is provided
    elseif ($new_password !== null) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update password"]);
        }
        $stmt->close();
    }
    // Retrieve user information if no updates are provided
    else {
        $stmt = $conn->prepare("SELECT last_name, first_name, middle_name, suffix, address, birthdate, civil_status, personal_email, account_email FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode(["success" => true, "user" => $user]);
        } else {
            echo json_encode(["success" => false, "message" => "User not found"]);
        }
        $stmt->close();
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
}

$conn->close();
?>
