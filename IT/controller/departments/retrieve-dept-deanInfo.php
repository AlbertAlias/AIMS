<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include '../../../dbconn.php';

if (isset($_GET['dept_id'])) {
    $dept_id = intval($_GET['dept_id']);

    // Fetch dean and department information
    $sql = "SELECT 
                departments.id AS department_id,
                departments.department_name, 
                users.last_name, 
                users.first_name, 
                users.username,
                departments.dean_id
            FROM departments
            LEFT JOIN dean ON departments.dean_id = dean.id
            LEFT JOIN users ON dean.user_id = users.id
            WHERE departments.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dept_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $departmentData = $result->fetch_assoc();
        
        // Fetch all departments for the dropdown
        $allDepartmentsSql = "SELECT id AS department_id, department_name FROM departments";
        $allDepartmentsResult = $conn->query($allDepartmentsSql);

        $allDepartments = [];
        if ($allDepartmentsResult->num_rows > 0) {
            while ($row = $allDepartmentsResult->fetch_assoc()) {
                $allDepartments[] = $row;
            }
        }

        echo json_encode([
            'success' => true,
            'dean' => $departmentData,
            'departments' => $allDepartments, // Include all departments for dropdown
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No dean found for the specified department.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No department ID provided.']);
}

$conn->close();
?>