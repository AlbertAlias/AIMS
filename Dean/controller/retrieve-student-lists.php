<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $deanUserId = $_SESSION['user_id'];

    // Fetch departments managed by the logged-in dean
    $deptQuery = "SELECT department_id FROM dean_department WHERE dean_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }

    $deptStmt->bind_param('i', $deanUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result();

    $departmentIds = [];
    while ($row = $deptResult->fetch_assoc()) {
        $departmentIds[] = $row['department_id'];
    }

    if (empty($departmentIds)) {
        throw new Exception('No departments assigned to the logged-in dean.');
    }

    // Convert department IDs into a comma-separated string for SQL queries
    $departmentIdsStr = implode(',', $departmentIds);

    // Handle pagination and search parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $start = ($page - 1) * $length;

    // Fetch the students based on the departments managed by the dean
    $studentQuery = "
        SELECT 
            u.user_id, 
            u.first_name, 
            u.last_name, 
            u.gender, 
            u.student_id, 
            u.email, 
            d.department_name,
            u.address,
            u.academic_year
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Student'
        AND u.department_id IN ($departmentIdsStr)
        AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
        LIMIT ?, ?";
    
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare query.');
    }

    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for table rows
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['student_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['address']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['academic_year']) . '</td>';
        $html .= '</tr>';
    }

    // Fetch total number of students for pagination
    $countQuery = "
        SELECT COUNT(*) AS total
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Student'
        AND u.department_id IN ($departmentIdsStr)
        AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";

    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare total count query.');
    }

    $countStmt->bind_param('s', $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $totalRecords = $countResult['total'];

    // Handle pagination calculation
    $totalPages = ceil($totalRecords / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= "<li class='page-item " . ($i === $page ? 'active' : '') . "'>
            <a class='page-link' href='#' data-page='{$i}'>{$i}</a>
        </li>";
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
