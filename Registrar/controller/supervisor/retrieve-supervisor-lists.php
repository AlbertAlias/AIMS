<?php
header('Content-Type: application/json');
include '../../../archive_dbconn.php';  // Archive DB connection for supervisors
include '../../../dbconn.php';         // AIMS DB connection for registrar

try {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    // Use AIMS DB connection to check user type (Registrar)
    $userTypeQuery = "SELECT user_type FROM users WHERE user_id = ?";
    $userTypeStmt = $conn->prepare($userTypeQuery);
    if (!$userTypeStmt) {
        throw new Exception('Failed to prepare user type query.');
    }
    $userTypeStmt->bind_param('i', $_SESSION['user_id']);
    $userTypeStmt->execute();
    $userTypeResult = $userTypeStmt->get_result()->fetch_assoc();

    if ($userTypeResult['user_type'] !== 'Registrar') {
        throw new Exception('Unauthorized access. Only registrar accounts can view this data.');
    }

    // Now, switch to Archive DB connection for supervisor data
    include '../../../archive_dbconn.php';  // Ensure archive DB connection for supervisor data

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $start = ($page - 1) * $length;

    $sql = "
    SELECT 
        users.user_id AS userID,
        CONCAT(users.first_name, ' ', users.last_name) AS name,
        department.department_name AS department,
        users.email AS email,
        users.username AS username,
        users.user_type AS userType,
        users.company AS company,
        users.company_address AS companyAddress
    FROM users
    LEFT JOIN department ON users.department_id = department.department_id
    WHERE users.user_type = 'Supervisor'
    AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email, users.company, users.company_address) LIKE ?
    LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';
    if ($result->num_rows === 0) {
        $html = '<tr><td colspan="7">No data available</td></tr>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']) ?: '--';
            $department = htmlspecialchars($row['department']) ?: '--';
            $email = htmlspecialchars($row['email']) ?: '--';
            $username = htmlspecialchars($row['username']) ?: '--';
            $userType = htmlspecialchars($row['userType']) ?: '--';
            $company = htmlspecialchars($row['company']) ?: '--';
            $companyAddress = htmlspecialchars($row['companyAddress']) ?: '--';

            $html .= '<tr>';
            $html .= "<td>{$name}</td>";
            $html .= "<td>{$department}</td>";
            $html .= "<td>{$email}</td>";
            $html .= "<td>{$username}</td>";
            $html .= "<td>{$userType}</td>";
            $html .= "<td>{$company}</td>";
            $html .= "<td>{$companyAddress}</td>";
            $html .= '</tr>';
        }
    }

    // Pagination count query
    $countSql = "
    SELECT COUNT(*) AS total 
    FROM users 
    WHERE user_type = 'Supervisor'
    AND CONCAT_WS(' ', first_name, last_name, email) LIKE ?";

    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param('s', $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $total = $countResult['total'];

    $totalPages = ceil($total / $length);
    $pagination = '';
    $maxVisiblePages = 3;
    $startPage = max(1, $page - floor($maxVisiblePages / 2));
    $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

    if ($endPage - $startPage + 1 < $maxVisiblePages) {
        $startPage = max(1, $endPage - $maxVisiblePages + 1);
    }

    if ($page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
        $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
        $pagination .= '</li>';
    }

    if ($page < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
    }

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
$countStmt->close();
$conn->close();
?>