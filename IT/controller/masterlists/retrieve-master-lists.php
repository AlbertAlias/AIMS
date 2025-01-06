<?php
    header('Content-Type: application/json');

    include '../../../dbconn.php';

    try {
        // Get parameters
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $userType = isset($_GET['user_type']) ? $_GET['user_type'] : '';
        $departmentId = isset($_GET['department_id']) ? intval($_GET['department_id']) : null;
        $company = isset($_GET['company']) ? $_GET['company'] : '';

        // Define column visibility
        $columns = [
            'Name' => true,
            'Department' => $userType === '' || in_array($userType, ['Coordinator', 'Student']),
            'Company' => $userType === '' || in_array($userType, ['Supervisor']),
            'Email' => true,
            'AY' => $userType === '' || in_array($userType, ['Student']),
            'Username' => true,
            'UserType' => true
        ];

        // Prepare selected columns for SQL query
        $selectColumns = [];
        if ($columns['Name']) $selectColumns[] = "CONCAT(users.last_name, ', ', users.first_name) AS Name";
        if ($columns['Department']) $selectColumns[] = "department.department_name AS Department";
        if ($columns['Company']) $selectColumns[] = "users.company AS Company";
        if ($columns['Email']) $selectColumns[] = "users.email AS Email";
        if ($columns['AY']) $selectColumns[] = "users.academic_year AS AY";
        if ($columns['Username']) $selectColumns[] = "users.username AS Username";
        if ($columns['UserType']) $selectColumns[] = "users.user_type AS UserType";

        $sqlColumns = implode(', ', $selectColumns);

        // Calculate pagination
        $start = ($page - 1) * $length;
        
        $sql = "
        SELECT 
            $sqlColumns
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        WHERE CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email, users.username, users.user_type) LIKE ?";

        // If a user_type is specified, add it to the WHERE clause
        if ($userType) {
            $sql .= " AND users.user_type = ?";
        }

        // If Supervisor is selected and company is specified, add company filter
        if ($userType === 'Supervisor' && $company) {
            $sql .= " AND users.company = ?";
        }

        // If department_id is provided and user_type is 'Student', filter by department
        if ($userType === 'Student' && $departmentId) {
            $sql .= " AND users.department_id = ?";
        }

        $sql .= " LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";

        if ($userType === 'Supervisor' && $company) {
            $stmt->bind_param('sssii', $searchTerm, $userType, $company, $start, $length);
        } else if ($userType === 'Student' && $departmentId) {
            $stmt->bind_param('ssiii', $searchTerm, $userType, $departmentId, $start, $length);
        } else if ($userType) {
            $stmt->bind_param('ssii', $searchTerm, $userType, $start, $length);
        } else {
            $stmt->bind_param('sii', $searchTerm, $start, $length);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $html = '';
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            if ($columns['Name']) $html .= '<td>' . (htmlspecialchars($row['Name']) ?: '--') . '</td>';
            if ($columns['Department']) $html .= '<td>' . (htmlspecialchars($row['Department']) ?: '--') . '</td>';
            if ($columns['Company']) $html .= '<td>' . (htmlspecialchars($row['Company']) ?: '--') . '</td>';
            if ($columns['Email']) $html .= '<td>' . (htmlspecialchars($row['Email']) ?: '--') . '</td>';
            if ($columns['AY']) $html .= '<td>' . (htmlspecialchars($row['AY']) ?: '--') . '</td>';
            if ($columns['Username']) $html .= '<td>' . (htmlspecialchars($row['Username']) ?: '--') . '</td>';
            if ($columns['UserType']) $html .= '<td>' . (htmlspecialchars($row['UserType']) ?: '--') . '</td>';
            $html .= '<td><button class="btn btn-sm btn-warning" disabled>Archived</button></td>';
            $html .= '</tr>';
        }

        // Fetch total count for pagination
        $totalSql = "
        SELECT COUNT(*) AS total
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        WHERE CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email, users.username, users.user_type) LIKE ?";

        // If a user_type is specified, add it to the WHERE clause
        if ($userType) {
            $totalSql .= " AND users.user_type = ?";
        }

        // If Supervisor is selected and company is specified, add company filter
        if ($userType === 'Supervisor' && $company) {
            $totalSql .= " AND users.company = ?";
        }

        $totalStmt = $conn->prepare($totalSql);
        if ($userType === 'Supervisor' && $company) {
            $totalStmt->bind_param('sss', $searchTerm, $userType, $company);
        } else if ($userType) {
            $totalStmt->bind_param('ss', $searchTerm, $userType);
        } else {
            $totalStmt->bind_param('s', $searchTerm);
        }
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $total = $totalResult->fetch_assoc()['total'];

        // Generate pagination links with a limited display
        $totalPages = ceil($total / $length);
        $pagination = '';
        $maxVisiblePages = 3; // Number of pages to show at a time
        $startPage = max(1, $page - floor($maxVisiblePages / 2));
        $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

        if ($endPage - $startPage + 1 < $maxVisiblePages) {
            $startPage = max(1, $endPage - $maxVisiblePages + 1);
        }

        // Previous button
        if ($page > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
        }

        // Main pagination buttons
        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
            $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
            $pagination .= '</li>';
        }

        // Next button
        if ($page < $totalPages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
        }

        // Return JSON response
        $response = [
            'html' => $html,
            'pagination' => $pagination,
            'start' => $start + 1,
            'end' => min($start + $length, $total),
            'total' => $total
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    $stmt->close();
    $totalStmt->close();
    $conn->close();
?>