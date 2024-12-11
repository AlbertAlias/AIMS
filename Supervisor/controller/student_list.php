<?php
header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $supervisorUserId = $_SESSION['user_id'];

    // Fetch the company for the logged-in supervisor
    $companyQuery = "SELECT company FROM users WHERE user_id = ? AND user_type = 'Supervisor'";
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
    $company = $companyResult['company'];

    // Get pagination and search parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Calculate pagination
    $start = ($page - 1) * $length;

    // Query to get filtered and paginated students
    $studentQuery = "
        SELECT user_id, first_name, last_name, company 
        FROM users 
        WHERE user_type = 'Student' 
          AND company = ? 
          AND CONCAT_WS(' ', first_name, last_name, username, email) LIKE ? 
        LIMIT ?, ?";
    $stmt = $conn->prepare($studentQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare student query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('ssii', $company, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML table rows with checkboxes
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td><input type="checkbox" class="userCheckbox" data-id="' . htmlspecialchars($row['user_id']) . '"></td>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['company']) . '</td>';
        $html .= '</tr>';
    }

    // Query to get total student count for pagination
    $countQuery = "
        SELECT COUNT(*) AS total 
        FROM users 
        WHERE user_type = 'Student' 
          AND company = ? 
          AND CONCAT_WS(' ', first_name, last_name, username, email) LIKE ?";
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('ss', $company, $searchTerm);
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
