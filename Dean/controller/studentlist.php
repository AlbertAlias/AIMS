<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $deanUserId = $_SESSION['user_id'];

    // Query to fetch all department IDs handled by the dean
    $deptQuery = "SELECT department_id FROM department WHERE dean_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }
    $deptStmt->bind_param('i', $deanUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result();

    // Collect all department IDs into an array
    $departmentIds = [];
    while ($row = $deptResult->fetch_assoc()) {
        $departmentIds[] = $row['department_id'];
    }

    if (empty($departmentIds)) {
        throw new Exception('No departments found for the dean.');
    }

    // Convert department IDs to a comma-separated string for the SQL IN clause
    $departmentIdsStr = implode(',', $departmentIds);

    // Get pagination and search parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Calculate pagination
    $start = ($page - 1) * $length;

    // Query to get filtered and paginated students with department name
    $studentQuery = "
        SELECT 
            users.user_id, 
            users.first_name, 
            users.last_name, 
            users.gender, 
            users.student_id,
            users.company, 
            users.emergency_number,
            users.email,
            users.address,
            users.academic_year,
            department.department_name
        FROM users
        INNER JOIN department ON users.department_id = department.department_id
        WHERE users.user_type = 'Student'
          AND users.department_id IN ($departmentIdsStr)
          AND CONCAT_WS(' ', users.first_name, users.last_name, users.username, users.email) LIKE ?
        LIMIT ?, ?";
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare student query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML table rows with department name
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['student_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['company']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['emergency_number']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['address']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['academic_year']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total student count for pagination
    $countQuery = "
        SELECT COUNT(*) AS total
        FROM users
        INNER JOIN department ON users.department_id = department.department_id
        WHERE users.user_type = 'Student'
          AND users.department_id IN ($departmentIdsStr)
          AND CONCAT_WS(' ', users.first_name, users.last_name, users.username, users.email) LIKE ?";
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('s', $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $totalRecords = $countResult['total'];

    // Generate pagination
    $totalPages = ceil($totalRecords / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item ' . ($i === $page ? 'active' : '') . '">
            <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }

    // Return JSON response
    echo json_encode([
        'html' => $html,
        'pagination' => $pagination,
        'start' => $start + 1,
        'end' => min($start + $length, $totalRecords),
        'total' => $totalRecords
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
$conn->close();
?>
