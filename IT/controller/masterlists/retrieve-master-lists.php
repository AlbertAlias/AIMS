<?php
    header('Content-Type: application/json');

    include '../../../dbconn.php';

    try {
        // Get parameters
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Calculate pagination
        $start = ($page - 1) * $length;

        // Query to get filtered and paginated data
        $sql = "
        SELECT 
            CONCAT(users.last_name, ', ', users.first_name) AS Name,
            department.department_name AS Department,
            users.company AS Company,
            users.email AS Email,
            users.academic_year AS AY,
            users.username AS Username,
            users.user_type AS UserType
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        WHERE CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email, users.username, users.user_type) LIKE ?
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('sii', $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        // Generate table rows
        $html = '';
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['Name']) ?: '--';
            $department = htmlspecialchars($row['Department']) ?: '--';
            $company = htmlspecialchars($row['Company']) ?: '--';
            $email = htmlspecialchars($row['Email']) ?: '--';
            $academicYear = htmlspecialchars($row['AY']) ?: '--';
            $username = htmlspecialchars($row['Username']) ?: '--';
            $userType = htmlspecialchars($row['UserType']) ?: '--';

            $html .= '<tr>';
            $html .= '<td>' . $name . '</td>';
            $html .= '<td>' . $department . '</td>';
            $html .= '<td>' . $company . '</td>';
            $html .= '<td>' . $email . '</td>';
            $html .= '<td>' . $academicYear . '</td>';
            $html .= '<td>' . $username . '</td>';
            $html .= '<td>' . $userType . '</td>';
            $html .= '</tr>';
        }

        // Fetch total count for pagination
        $totalSql = "
        SELECT COUNT(*) AS total
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        WHERE CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email, users.username, users.user_type) LIKE ?";
        $totalStmt = $conn->prepare($totalSql);
        $totalStmt->bind_param('s', $searchTerm);
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