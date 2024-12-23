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

        // Query to fetch coordinators managed by the dean
        $sql = "
            SELECT 
                u.user_id, 
                u.first_name, 
                u.last_name, 
                u.department_id, 
                d.department_name
            FROM users u
            INNER JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Coordinator'
            AND u.department_id IN ($departmentIdsStr)
            AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
            LIMIT ?, ?";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Failed to prepare query.');
        }

        $searchTerm = "%$search%";
        $stmt->bind_param('sii', $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        // Generate table rows
        $html = '';
        while ($row = $result->fetch_assoc()) {
            $first_name = htmlspecialchars($row['first_name']) ?: '--';
            $last_name = htmlspecialchars($row['last_name']) ?: '--';
            $department_name = htmlspecialchars($row['department_name']) ?: '--';
            $department_id = htmlspecialchars($row['department_id']) ?: '--';

            $html .= '<tr>';
            $html .= '<td>' . $first_name . '</td>';
            $html .= '<td>' . $last_name . '</td>';
            $html .= '<td>' . $department_name . '</td>';
            $html .= '<td>' . $department_id . '</td>';
            $html .= '</tr>';
        }

        // Query to get total count for pagination
        $totalSql = "
            SELECT COUNT(*) AS total
            FROM users u
            INNER JOIN department d ON u.department_id = d.department_id
            WHERE u.user_type = 'Coordinator'
            AND u.department_id IN ($departmentIdsStr)
            AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
        
        $totalStmt = $conn->prepare($totalSql);
        if (!$totalStmt) {
            throw new Exception('Failed to prepare total count query.');
        }

        $totalStmt->bind_param('s', $searchTerm);
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $total = $totalResult->fetch_assoc()['total'];

        // Calculate pagination
        $totalPages = ceil($total / $length);
        $pagination = '';
        $maxVisiblePages = 3;
        $startPage = max(1, $page - floor($maxVisiblePages / 2));
        $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

        if ($endPage - $startPage + 1 < $maxVisiblePages) {
            $startPage = max(1, $endPage - $maxVisiblePages + 1);
        }

        if ($startPage > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
            if ($startPage > 2) {
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
            $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
            $pagination .= '</li>';
        }

        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
        }

        // Return JSON response
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

    $stmt->close();
    $totalStmt->close();
    $conn->close();
?>