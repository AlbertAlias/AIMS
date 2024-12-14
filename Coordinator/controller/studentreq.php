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

    $start = ($page - 1) * $length;

    // Query to fetch paginated data with department name
    $studentQuery = "
        SELECT 
            u.first_name, 
            u.last_name, 
            u.student_id, 
            d.department_name, 
            u.company 
        FROM users u
        LEFT JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Student' 
          AND u.department_id = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ? 
        LIMIT ?, ?";
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare student query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('isii', $departmentId, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML rows
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['student_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['company']) . '</td>';
        $html .= '<td>
            <button class="btn btn-primary btn-sm open-modal-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#actionModal" 
                    data-id="' . htmlspecialchars($row['student_id']) . '">
                Action
            </button>
        </td>';
        $html .= '</tr>';
    }

    // Query to get total students for pagination
    $countQuery = "
        SELECT COUNT(*) AS total 
        FROM users u
        LEFT JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Student' 
          AND u.department_id = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('is', $departmentId, $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $totalRecords = $countResult['total'];

    // Handle edge case when no records are found
    if ($totalRecords <= 0) {
        $pagination = '';
    } else {
        $totalPages = ceil($totalRecords / $length);

        // Show only a maximum range of 5 pages around the current page
        $pagination = '';
        $pageRange = 2; // How many pages to show left and right of the current page
        $startPage = max(1, $page - $pageRange);
        $endPage = min($totalPages, $page + $pageRange);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagination .= '<li class="page-item ' . ($i === $page ? 'active' : '') . '">
                <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>
            </li>';
        }
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
?>
