<?php
header('Content-Type: application/json');

include '../../dbconn.php';

try {
    // Assume coordinator is logged in and their user ID is stored in a session
    session_start();
    $coordinatorUserId = $_SESSION['user_id']; // Replace with actual session variable

    // Fetch the department_id for the logged-in coordinator
    $deptQuery = "SELECT department_id FROM users WHERE id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    $deptStmt->bind_param('i', $coordinatorUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result()->fetch_assoc();

    if (!$deptResult) {
        throw new Exception('Invalid coordinator account.');
    }
    $departmentId = $deptResult['department_id'];

    // Get parameters
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Calculate pagination
    $start = ($page - 1) * $length;

    // Query to get filtered and paginated data for students in the coordinator's department
    $sql = "SELECT id, employee_no, last_name, first_name, middle_name, gender, personal_email, username, user_type, department_id 
            FROM users 
            WHERE user_type = 'student' 
              AND department_id = ? 
              AND CONCAT_WS(' ', first_name, last_name, employee_no, personal_email, username) LIKE ? 
            LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('isii', $departmentId, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate table rows with checkboxes
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td><input type="checkbox" class="userCheckbox" data-id="' . $row['id'] . '"></td>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_id']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total count for pagination
    $totalSql = "SELECT COUNT(*) AS total 
                 FROM users 
                 WHERE user_type = 'student' 
                   AND department_id = ? 
                   AND CONCAT_WS(' ', first_name, last_name, employee_no, personal_email, username) LIKE ?";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('is', $departmentId, $searchTerm);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result()->fetch_assoc();
    $totalRecords = $totalResult['total'];

    // Pagination logic
    $totalPages = ceil($totalRecords / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item ' . ($i === $page ? 'active' : '') . '">
            <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }

    // Send JSON response
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
