<?php
header("Content-Type: application/json");
include '../../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    $dean_id = $_SESSION['user_id'];

    // Refined query to count distinct students who finished the required hours
    $sql = "
        SELECT 
            d.department_id, d.department_name, 
            -- Male students who finished hours (distinct students)
            (SELECT COUNT(DISTINCT u.user_id) 
             FROM users u 
             JOIN student_hours sh ON u.department_id = d.department_id
             WHERE u.user_type = 'Student' 
               AND u.department_id = d.department_id
               AND u.gender = 'Male'
               AND u.rendered_hours >= sh.hours_needed) AS male_finished_count,
            -- Female students who finished hours (distinct students)
            (SELECT COUNT(DISTINCT u.user_id) 
             FROM users u 
             JOIN student_hours sh ON u.department_id = d.department_id
             WHERE u.user_type = 'Student' 
               AND u.department_id = d.department_id
               AND u.gender = 'Female'
               AND u.rendered_hours >= sh.hours_needed) AS female_finished_count
        FROM department d
        INNER JOIN dean_department dd ON dd.department_id = d.department_id
        WHERE dd.dean_id = ?;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $dean_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        // Count of distinct male and female students who have finished their hours
        $male_finished = (int) $row['male_finished_count'];
        $female_finished = (int) $row['female_finished_count'];

        $data[] = [
            'department_id' => $row['department_id'],
            'department_name' => $row['department_name'],
            'male_finished_count' => $male_finished,
            'female_finished_count' => $female_finished,
        ];
    }

    echo json_encode($data);
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>