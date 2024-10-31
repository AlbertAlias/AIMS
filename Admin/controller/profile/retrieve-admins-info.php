<?php
include '../../../dbconn.php';

$request = json_decode(file_get_contents("php://input"));
$user_id = $request->user_id ?? null;

if ($user_id) {
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
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
}
$conn->close();
?>