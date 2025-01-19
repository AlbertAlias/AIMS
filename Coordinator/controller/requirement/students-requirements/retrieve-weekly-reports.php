<?php
    include '../../../../dbconn.php';

    session_start();
    $department_id = $_SESSION['department_id'];

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $searchQuery = "AND (u.first_name LIKE '%$search%' OR u.last_name LIKE '%$search%')";
    } else {
        $searchQuery = '';
    }

    $query = "
        SELECT wr.id, wr.title, wr.student_id, wr.file_path, u.first_name, u.last_name 
        FROM weekly_reports wr
        JOIN users u ON wr.student_id = u.user_id
        WHERE u.department_id = ? $searchQuery
        ORDER BY wr.id DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $department_id); // Bind the department_id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['file_path'] = '/AIMS/Student/controller/weeklyreport/uploads/' . basename($row['file_path']);
            $data[] = $row;
        }
    }

    echo json_encode($data);

    $conn->close();
?>