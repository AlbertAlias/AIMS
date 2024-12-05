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
    $sql = "SELECT id, employee_no, last_name, first_name, middle_name, gender, personal_email, username, user_type, department_id 
        FROM users 
        WHERE CONCAT_WS(' ', first_name, last_name, employee_no, personal_email, username, user_type) LIKE ? 
        LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
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
        $html .= '<td>' . htmlspecialchars($row['employee_no']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['personal_email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['username']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['user_type']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total count for pagination
    $totalSql = "SELECT COUNT(*) AS total FROM users WHERE CONCAT_WS(' ', first_name, last_name, employee_no, personal_email, username, user_type) LIKE ?";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('s', $searchTerm);
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
