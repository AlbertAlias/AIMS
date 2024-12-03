<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../dbconn.php';

try {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $department = isset($_GET['department']) ? intval($_GET['department']) : null;

    $start = ($page - 1) * $length;

    $sql = "SELECT u.first_name, u.last_name, u.username, i.studentID, d.department_name 
            FROM users u
            JOIN interns i ON u.id = i.user_id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE u.user_type = 'intern' 
            AND CONCAT_WS(' ', u.first_name, u.last_name, d.department_name, i.studentID, u.username) LIKE ?";
    if ($department) {
        $sql .= " AND u.department_id = ?";
    }
    $sql .= " LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    if ($department) {
        $stmt->bind_param('siii', $searchTerm, $department, $start, $length);
    } else {
        $stmt->bind_param('sii', $searchTerm, $start, $length);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['username']) . '</td>';
        $html .= '<td><button class="btn btn-sm btn-info">Edit</button> <button class="btn btn-sm btn-danger">Delete</button></td>';
        $html .= '</tr>';
    }

    $totalSql = "SELECT COUNT(*) AS total FROM users u 
                 JOIN interns i ON u.id = i.user_id 
                 LEFT JOIN departments d ON u.department_id = d.id 
                 WHERE u.user_type = 'intern' 
                 AND CONCAT_WS(' ', u.first_name, u.last_name, d.department_name, i.studentID, u.username) LIKE ?";
    if ($department) {
        $totalSql .= " AND u.department_id = ?";
    }

    $totalStmt = $conn->prepare($totalSql);
    if ($department) {
        $totalStmt->bind_param('si', $searchTerm, $department);
    } else {
        $totalStmt->bind_param('s', $searchTerm);
    }
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

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
    // Return error message as JSON if something goes wrong
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $stmt->close();
    $totalStmt->close();
    $conn->close();
}
?>