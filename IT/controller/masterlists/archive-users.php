<?php
// include '../../../dbconn.php';

// if (isset($_POST['delete_user_id'])) {
//     $userIdToDelete = $_POST['delete_user_id'];

//     // Start a transaction to ensure that all related data is deleted
//     $conn->begin_transaction();

//     try {
//         // Delete from coordinator table
//         $stmt = $conn->prepare("DELETE FROM coordinator WHERE user_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from coordinator_evaluations table
//         $stmt = $conn->prepare("DELETE FROM coordinator_evaluations WHERE evaluator_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from student_hours table
//         $stmt = $conn->prepare("DELETE FROM student_hours WHERE coordinator_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from ojt_hours table
//         $stmt = $conn->prepare("DELETE FROM ojt_hours WHERE student_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from weekly_reports table
//         $stmt = $conn->prepare("DELETE FROM weekly_reports WHERE student_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from requirements table
//         $stmt = $conn->prepare("DELETE FROM requirements WHERE coordinator_id = ?;");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Delete from coordinator_evaluations table
//         $stmt = $conn->prepare("DELETE FROM coordinator_evaluations WHERE student_id = ?;");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();
//         // Add more delete queries for other tables (like student_supervisor, submit_requirements, etc.)

//         // Delete from the user table
//         $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
//         $stmt->bind_param("i", $userIdToDelete);
//         $stmt->execute();

//         // Commit the transaction
//         $conn->commit();

//         echo json_encode(['status' => 'success', 'message' => 'User and related data deleted successfully.']);
//     } catch (Exception $e) {
//         // If any query fails, roll back the transaction
//         $conn->rollback();
//         echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $e->getMessage()]);
//     }
// }
?>
<?php
include '../../../dbconn.php'; // Ensure this file connects to both `aims_db` and `archive_db`

if (isset($_POST['delete_user_id'])) {
    $userIdToDelete = $_POST['delete_user_id'];

    // Begin a transaction for the aims_db
    $conn->begin_transaction();

    try {
        // Archive department if not already archived
        $stmt = $conn->prepare("INSERT IGNORE INTO archive_db.department SELECT * FROM aims_db.department WHERE department_id = (SELECT department_id FROM aims_db.users WHERE user_id = ?)");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive user data from aims_db.users to archive_db.users
        $stmt = $conn->prepare("INSERT INTO archive_db.users SELECT * FROM aims_db.users WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive related coordinator data
        $stmt = $conn->prepare("INSERT INTO archive_db.coordinator SELECT * FROM aims_db.coordinator WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive coordinator evaluations
        $stmt = $conn->prepare("INSERT INTO archive_db.coordinator_evaluations SELECT * FROM aims_db.coordinator_evaluations WHERE evaluator_id = ? OR student_id = ?");
        $stmt->bind_param("ii", $userIdToDelete, $userIdToDelete);
        $stmt->execute();

        // Archive student hours
        $stmt = $conn->prepare("INSERT INTO archive_db.student_hours SELECT * FROM aims_db.student_hours WHERE coordinator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive OJT hours
        $stmt = $conn->prepare("INSERT INTO archive_db.ojt_hours SELECT * FROM aims_db.ojt_hours WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive weekly reports
        $stmt = $conn->prepare("INSERT INTO archive_db.weekly_reports SELECT * FROM aims_db.weekly_reports WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Archive requirements
        $stmt = $conn->prepare("INSERT INTO archive_db.requirements SELECT * FROM aims_db.requirements WHERE coordinator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Now delete from aims_db
        $stmt = $conn->prepare("DELETE FROM aims_db.users WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.coordinator WHERE user_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.coordinator_evaluations WHERE evaluator_id = ? OR student_id = ?");
        $stmt->bind_param("ii", $userIdToDelete, $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.student_hours WHERE coordinator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.ojt_hours WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.weekly_reports WHERE student_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM aims_db.requirements WHERE coordinator_id = ?");
        $stmt->bind_param("i", $userIdToDelete);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        echo json_encode(['status' => 'success', 'message' => 'User archived and related data moved successfully.']);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Error archiving user: ' . $e->getMessage()]);
    }
}
?>

