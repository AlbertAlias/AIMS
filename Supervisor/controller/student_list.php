<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $supervisorUserId = $_SESSION['user_id'];

    // Fetch the supervisor's company from the student_supervisor table
    $companyQuery = "
        SELECT DISTINCT company 
        FROM student_supervisor 
        WHERE supervisor_id = ?
    ";
    $companyStmt = $conn->prepare($companyQuery);
    if (!$companyStmt) {
        throw new Exception('Failed to prepare company query.');
    }
    $companyStmt->bind_param('i', $supervisorUserId);
    $companyStmt->execute();
    $companyResult = $companyStmt->get_result()->fetch_assoc();

    if (!$companyResult || empty($companyResult['company'])) {
        throw new Exception('Supervisor account does not have a linked company.');
    }
    $supervisorCompany = $companyResult['company'];

    // Handle pagination and search
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $start = ($page - 1) * $length;

    // Query to retrieve students assigned to this supervisor's company via student_supervisor
    $studentQuery = "
        SELECT u.user_id, u.first_name, u.last_name, u.department_id, u.company, d.department_name
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
        WHERE ss.company = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
        LIMIT ?, ?";
    
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare student query.');
    }

    $searchTerm = "%$search%";
    $stmt->bind_param('ssii', $supervisorCompany, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>';
        $html .= '<button class="btn btn-primary" onclick="evaluateStudent(' . htmlspecialchars($row['user_id']) . ')">Evaluate</button>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    // Pagination: Get total number of records
    $countQuery = "
        SELECT COUNT(*) AS total 
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
        WHERE ss.company = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('ss', $supervisorCompany, $searchTerm);
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
