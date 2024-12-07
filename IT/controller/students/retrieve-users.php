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
    $sql = "SELECT u.id, u.last_name, u.first_name, u.middle_name, u.gender, 
               u.personal_email, u.username, u.user_type, d.department_name, s.student_id
            FROM users u
            LEFT JOIN dept_dean d ON u.department_id = d.id
            LEFT JOIN student s ON u.id = s.user_id
            WHERE CONCAT_WS(' ', u.first_name, u.last_name, u.personal_email, u.username, u.user_type) LIKE ? 
            LIMIT ?, ?";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate table rows
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['personal_email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['username']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['user_type']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total count for pagination
    $totalSql = "
        SELECT COUNT(*) AS total 
        FROM users u
        JOIN students s ON u.id = s.user_id
        LEFT JOIN department_dean d ON u.department_id = d.id
        WHERE CONCAT_WS(' ', u.first_name, u.last_name, d.department_name, s.studentID, u.personal_email, u.user_type) LIKE ?";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('s', $searchTerm);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

    // Generate pagination links
    $totalPages = ceil($total / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '">';
        $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
        $pagination .= '</li>';
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