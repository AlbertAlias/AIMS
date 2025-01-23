<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $deanUserId = $_SESSION['user_id'];

    $deptQuery = "SELECT department_id FROM dean_department WHERE dean_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
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

    $departmentIdsStr = implode(',', $departmentIds);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $start = ($page - 1) * $length;

    $sql = "
    SELECT 
        u.first_name, 
        u.last_name, 
        d.department_name, 
        d.department_id
    FROM users u
    INNER JOIN department d ON u.department_id = d.department_id
    WHERE u.user_type = 'Coordinator'
    AND u.department_id IN ($departmentIdsStr)
    AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
    LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';
    if ($result->num_rows === 0) {
        $html = '<tr><td colspan="4">No data available</td></tr>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['department_id']) . '</td>';
            $html .= '</tr>';
        }
    }

    $totalSql = "
    SELECT COUNT(*) AS total
    FROM users u
    INNER JOIN department d ON u.department_id = d.department_id
    WHERE u.user_type = 'Coordinator'
    AND u.department_id IN ($departmentIdsStr)
    AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('s', $searchTerm);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

    $pagination = '';
    $totalPages = ceil($total / $length);
    $startPage = max(1, $page - 1);
    $endPage = min($totalPages, $startPage + 2);

    if ($page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        $pagination .= '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
        $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
        $pagination .= '</li>';
    }

    if ($page < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
    }

    echo json_encode([
        'html' => $html,
        'pagination' => $pagination,
        'start' => $start + 1,
        'end' => min($start + $length, $total),
        'total' => $total
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
