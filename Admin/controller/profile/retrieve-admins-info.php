<?php
include '../../../dbconn.php';

// Decode the incoming JSON request
$request = json_decode(file_get_contents("php://input"));
$user_id = $request->user_id ?? null;
$password = $request->password ?? null;
$new_password = $request->new_password ?? null;

if ($user_id) {
    // If password is provided, verify the password
    if ($password !== null) {
        // Verify old password
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
    // If new password is provided, update the password
    elseif ($new_password !== null) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the user's password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update password"]);
        }
        $stmt->close();
    } else {
        // Retrieve user info if no password is provided
        $stmt = $conn->prepare("SELECT last_name, first_name, middle_name, suffix, address, birthdate, civil_status, personal_email, account_email 
                                FROM users WHERE id = ?");
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