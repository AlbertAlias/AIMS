<?php
include '../../../dbconn.php';

if (isset($_POST['delete_user_id'])) {
    $userIdToDelete = $_POST['delete_user_id'];

    // Start a transaction to ensure that all related data is deleted
    $conn->begin_transaction();

    try {
        // Delete from coordinator table
        $stmt = $conn->prepare("DELETE FROM coordinator WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from coordinator_evaluations table
        $stmt = $conn->prepare("DELETE FROM coordinator_evaluations WHERE evaluator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from student_hours table
        $stmt = $conn->prepare("DELETE FROM student_hours WHERE coordinator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from ojt_hours table
        $stmt = $conn->prepare("DELETE FROM ojt_hours WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from weekly_reports table
        $stmt = $conn->prepare("DELETE FROM weekly_reports WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from requirements table
        $stmt = $conn->prepare("DELETE FROM requirements WHERE coordinator_id = ?;");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Delete from coordinator_evaluations table
        $stmt = $conn->prepare("DELETE FROM coordinator_evaluations WHERE student_id = ?;");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();
        // Add more delete queries for other tables (like student_supervisor, submit_requirements, etc.)

        // Delete from the user table
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        echo json_encode(['status' => 'success', 'message' => 'User and related data deleted successfully.']);
    } catch (Exception $e) {
        // If any query fails, roll back the transaction
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $e->getMessage()]);
    }
}
?>
