<?php
header('Content-Type: application/json');
include '../../../archive_dbconn.php';  // For the archive_db queries (departments)
include '../../../dbconn.php';         // For the aims_db queries (users)

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_clean();

try {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    // First, check if the logged-in user is a registrar using the aims_db
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

    // Proceed with the data retrieval for coordinators from archive_db
    include '../../../archive_dbconn.php'; // Re-include archive_dbconn.php for this section

    // Data processing logic
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
        users.user_type AS userType
    FROM users
    LEFT JOIN department ON users.department_id = department.department_id
    WHERE users.user_type = 'Coordinator'
    AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?
    LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Failed to prepare coordinator query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for response
    $html = '';
    if ($result->num_rows === 0) {
        $html = '<tr><td colspan="5">No data available</td></tr>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']) ?: '--';
            $department = htmlspecialchars($row['department']) ?: '--';
            $email = htmlspecialchars($row['email']) ?: '--';
            $username = htmlspecialchars($row['username']) ?: '--';
            $userType = htmlspecialchars($row['userType']) ?: '--';

            $html .= '<tr>';
            $html .= "<td>{$name}</td>";
            $html .= "<td>{$department}</td>";
            $html .= "<td>{$email}</td>";
            $html .= "<td>{$username}</td>";
            $html .= "<td>{$userType}</td>";
            $html .= '</tr>';
        }
    }

    // Pagination logic
    $countSql = "
    SELECT COUNT(*) AS total 
    FROM users 
    WHERE user_type = 'Coordinator'
    AND CONCAT_WS(' ', first_name, last_name, email) LIKE ?";

    $countStmt = $conn->prepare($countSql);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
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

    // Response
    $response = [
        'html' => $html,
        'pagination' => $pagination,
        'start' => $start + 1,
        'end' => min($start + $length, $total),
        'total' => $total
    ];
    echo json_encode($response);

} catch (Exception $e) {
    // Log the error and return a proper JSON response
    error_log($e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}

// Close the database connections safely
if (isset($stmt)) {
    $stmt->close();
}
if (isset($countStmt)) {
    $countStmt->close();
}
$conn->close();
?>
