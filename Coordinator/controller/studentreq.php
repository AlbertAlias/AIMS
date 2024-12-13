<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $coordinatorUserId = $_SESSION['user_id'];

    // Fetch the department ID for the logged-in coordinator
    $deptQuery = "SELECT department_id FROM users WHERE user_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }
    $deptStmt->bind_param('i', $coordinatorUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result()->fetch_assoc();
    
    if (!$deptResult) {
        throw new Exception('Coordinator account does not have a linked department.');
    }
    $departmentId = $deptResult['department_id'];

    // Get pagination and search parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Calculate pagination
    $start = ($page - 1) * $length;

    // Query to get filtered and paginated students
    $studentQuery = "
        SELECT user_id, first_name, last_name, department_id 
        FROM users 
        WHERE user_type = 'Student' 
          AND department_id = ? 
          AND CONCAT_WS(' ', first_name, last_name, username, email) LIKE ? 
        LIMIT ?, ?";
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare student query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('isii', $departmentId, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML table rows with checkboxes
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td><input type="checkbox" class="userCheckbox" data-id="' . htmlspecialchars($row['user_id']) . '"></td>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_id']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total student count for pagination
    $countQuery = "
        SELECT COUNT(*) AS total 
        FROM users 
        WHERE user_type = 'Student' 
          AND department_id = ? 
          AND CONCAT_WS(' ', first_name, last_name, username, email) LIKE ?";
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('is', $departmentId, $searchTerm);
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