<?php
    require_once '../../../dbconn.php';
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the data from the POST request
        $id = (int)$_POST['id'];
        $last_name = $_POST['intern_last_name'];
        $first_name = $_POST['intern_first_name'];
        $gender = $_POST['intern_gender'];
        $student_id = $_POST['studentID'];
        $department_id = (int)$_POST['intern_department'];  // department_id sent from frontend
        $username = $_POST['intern_username'];
        $password = password_hash($_POST['intern_password'], PASSWORD_BCRYPT);

        // Validate that the department_id exists in the departments table
        $department_sql = "SELECT id FROM departments WHERE id = ?";
        $stmt = $conn->prepare($department_sql);
        $stmt->bind_param("i", $department_id);
        $stmt->execute();
        $stmt->bind_result($valid_id);
        $stmt->fetch();
        $stmt->close();

        if (!$valid_id) {
            $response['message'] = 'Invalid department ID provided: ' . $department_id;
            echo json_encode($response);
            exit;
        }

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Update the user data in the 'users' table (including department_id)
            $user_sql = "UPDATE users SET last_name = ?, first_name = ?, gender = ?, username = ?, password = ?, department_id = ? WHERE id = ?";
            $stmt = $conn->prepare($user_sql);
            if ($stmt === false) {
                throw new Exception('Failed to prepare user update statement');
            }
            $stmt->bind_param("ssssssi", $last_name, $first_name, $gender, $username, $password, $department_id, $id);
            $stmt->execute();

            // Update the intern data in the 'interns' table (without changing department_id)
            $intern_sql = "UPDATE interns SET studentID = ? WHERE user_id = ?";
            $intern_stmt = $conn->prepare($intern_sql);
            if ($intern_stmt === false) {
                throw new Exception('Failed to prepare intern update statement');
            }
            $intern_stmt->bind_param("si", $student_id, $id);
            $intern_stmt->execute();

            // Commit the transaction if everything went well
            $conn->commit();

            $response['success'] = true;
            $response['message'] = 'Intern updated successfully!';
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $conn->rollback();
            $response['message'] = 'Error updating intern: ' . $e->getMessage();
        }

        // Close the statements
        if (isset($stmt)) $stmt->close();
        if (isset($intern_stmt)) $intern_stmt->close();
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
?>