<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    // header('Content-Type: application/json');
    // include '../../../dbconn.php';

    // // Fetch the requirements from the database
    // $sql = "SELECT requirement_id, title, description, deadline, status FROM requirements ORDER BY created_at DESC";
    // $result = $conn->query($sql);

    // $requirements = [];
    // while ($row = $result->fetch_assoc()) {
    //     $requirements[] = [
    //         'requirement_id' => $row['requirement_id'],
    //         'title' => $row['title'],
    //         'description' => $row['description'],
    //         'deadline' => $row['deadline'],
    //         'status' => $row['status']
    //     ];
    // }

    // // Return the requirements as a JSON object
    // echo json_encode([
    //     'success' => true,
    //     'requirements' => $requirements
    // ]);
?>


<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');
    include '../../../dbconn.php';

    // Assuming the coordinator's user ID is stored in the session
    session_start();
    $coordinator_id = $_SESSION['user_id']; // The logged-in user's ID

    // Fetch only the posts created by the logged-in coordinator
    $sql = "SELECT r.requirement_id, r.title, r.description, DATE(r.deadline) AS deadline, r.status, u.first_name, u.last_name 
        FROM requirements r
        LEFT JOIN users u ON r.coordinator_id = u.user_id
        WHERE r.coordinator_id = ? 
        ORDER BY r.created_at DESC";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coordinator_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $requirements = [];
    while ($row = $result->fetch_assoc()) {
        $requirements[] = [
            'requirement_id' => $row['requirement_id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'deadline' => $row['deadline'],
            'status' => $row['status'],
            'coordinator_name' => $row['first_name'] . ' ' . $row['last_name'] // Get the full name of the coordinator
        ];
    }

    // Return the requirements as a JSON object
    echo json_encode([
        'success' => true,
        'requirements' => $requirements
    ]);
?>
