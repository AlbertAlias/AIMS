<?php
    require_once '../../../dbconn.php';
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)$_POST['id'];
        $last_name = $_POST['coor_last_name'];
        $first_name = $_POST['coor_first_name'];
        $middle_name = $_POST['coor_middle_name'];
        $suffix = $_POST['coor_suffix'];
        $address = $_POST['coor_address'];
        $personal_email = $_POST['coor_personal_email'];
        $employee_number = $_POST['coor_employee_number'];
        $department_id = (int)$_POST['coor_department'];
        $username = $_POST['coor_username'];
        $password = isset($_POST['coor_password']) ? $_POST['coor_password'] : null;

        $conn->begin_transaction();

        try {
            $user_sql = "UPDATE users SET last_name = ?, first_name = ?, middle_name = ?, suffix = ?, 
                        address = ?, personal_email = ?, employee_number = ?, username = ? WHERE id = ?";

            $stmt = $conn->prepare($user_sql);
            $stmt->bind_param("ssssssssi", $last_name, $first_name, $middle_name, $suffix, $address, $personal_email, $employee_number, $username, $id);
            $stmt->execute();

            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $password_sql = "UPDATE users SET password = ? WHERE id = ?";
                $password_stmt = $conn->prepare($password_sql);
                $password_stmt->bind_param("si", $hashed_password, $id);
                $password_stmt->execute();
                $password_stmt->close();
            }

            $coor_sql = "UPDATE coordinators SET department_id = ? WHERE user_id = ?";
            $coor_stmt = $conn->prepare($coor_sql);
            $coor_stmt->bind_param("ii", $department_id, $id);
            $coor_stmt->execute();

            $conn->commit();
            $response['success'] = true;
            $response['message'] = 'Coordinator updated successfully!';

        } catch (Exception $e) {
            $conn->rollback();
            $response['message'] = 'Error updating coordinator: ' . $e->getMessage();
        }

        $stmt->close();
        $coor_stmt->close();
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
?>