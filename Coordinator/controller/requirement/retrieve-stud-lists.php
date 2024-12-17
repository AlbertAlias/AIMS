<?php
// header('Content-Type: application/json');

// include '../../../dbconn.php';

// try {
//     // Get parameters
//     $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//     $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
//     $search = isset($_GET['search']) ? $_GET['search'] : '';

//     // Calculate pagination
//     $start = ($page - 1) * $length;

//     // Query to get filtered and paginated data
//     $sql = "SELECT 
//         users.user_id AS userID,
//         CONCAT(users.last_name, ' ', users.first_name) AS name,
//         department.department_name AS department,
//         users.email AS email,
//         supervisor.last_name AS supervisor_last_name,
//         supervisor.first_name AS supervisor_first_name,
//         supervisor.company AS supervisor_company,
//         supervisor.company_address AS supervisor_company_address
//     FROM users
//     LEFT JOIN department ON users.department_id = department.department_id
//     LEFT JOIN student_supervisor ON users.user_id = student_supervisor.student_id
//     LEFT JOIN users AS supervisor ON student_supervisor.supervisor_id = supervisor.user_id
//     WHERE users.user_type = 'Student'
//       AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?
//     LIMIT ?, ?";

//     $stmt = $conn->prepare($sql);
//     $searchTerm = "%$search%";
//     $stmt->bind_param('sii', $searchTerm, $start, $length);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Generate table rows
//     $html = '';
//     while ($row = $result->fetch_assoc()) {
//         // Check if any value is empty and replace with "N/A" or "--"
//         $name = htmlspecialchars($row['name']) ?: '--';
//         $department = htmlspecialchars($row['department']) ?: '--';
//         $email = htmlspecialchars($row['email']) ?: '--';
//         $supervisorName = htmlspecialchars($row['supervisor_first_name'] . ' ' . $row['supervisor_last_name']) ?: '--';
//         $supervisorCompany = htmlspecialchars($row['supervisor_company']) ?: '--';
//         $supervisorCompanyAddress = htmlspecialchars($row['supervisor_company_address']) ?: '--';

//         $html .= '<tr>';
//         $html .= '<td>' . $name . '</td>';
//         $html .= '<td>' . $department . '</td>';
//         $html .= '<td>' . $email . '</td>';
//         $html .= '<td>' . $supervisorName . '</td>';
//         $html .= '<td>' . $supervisorCompany . '</td>';
//         $html .= '<td>' . $supervisorCompanyAddress . '</td>';
//         $html .= '<td>
//             <button class="btn btn-success btn-sm open-modal-btn" data-bs-toggle="modal" data-bs-target="#assignSupervisorModal"
//                     data-user-id="' . $row['userID'] . '">Assign
//             </button>
//             <button class="btn btn-info btn-sm open-modal-btn" data-bs-toggle="modal" data-bs-target="#viewRequirementsModal" data-user-id="' . $row['userID'] . '">Requirements</button>
//         </td>';
//         $html .= '</tr>';
//     }

//     // Query to get total count for pagination
//     $totalSql = "SELECT COUNT(*) AS total
//          FROM users
//          LEFT JOIN department ON users.department_id = department.department_id
//          LEFT JOIN student_supervisor ON users.user_id = student_supervisor.student_id
//          LEFT JOIN users AS supervisor ON student_supervisor.supervisor_id = supervisor.user_id
//          WHERE users.user_type = 'Student'
//            AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?";
//     $totalStmt = $conn->prepare($totalSql);
//     $totalStmt->bind_param('s', $searchTerm);
//     $totalStmt->execute();
//     $totalResult = $totalStmt->get_result();
//     $total = $totalResult->fetch_assoc()['total'];

//     // Generate pagination links with a limited display
//     $totalPages = ceil($total / $length);
//     $pagination = '';
//     $maxVisiblePages = 3; // Number of pages to show at a time
//     $startPage = max(1, $page - floor($maxVisiblePages / 2));
//     $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

//     if ($endPage - $startPage + 1 < $maxVisiblePages) {
//         $startPage = max(1, $endPage - $maxVisiblePages + 1);
//     }

//     // First page button
//     if ($startPage > 1) {
//         $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
//         if ($startPage > 2) {
//             $pagination .= '<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-chevron-left"></i></span></li>';
//         }
//     }

//     // Main pagination buttons
//     for ($i = $startPage; $i <= $endPage; $i++) {
//         $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
//         $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
//         $pagination .= '</li>';
//     }

//     // Last page button
//     if ($endPage < $totalPages) {
//         if ($endPage < $totalPages - 1) {
//             $pagination .= '<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-chevron-right"></i></span></li>';
//         }
//         $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
//     }

//     // Return JSON response
//     $response = [
//         'html' => $html,
//         'pagination' => $pagination,
//         'start' => $start + 1,
//         'end' => min($start + $length, $total),
//         'total' => $total
//     ];
//     echo json_encode($response);
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }

// $stmt->close();
// $totalStmt->close();
// $conn->close();


// Revise ni Bryan
header('Content-Type: application/json');
include '../../../dbconn.php';

try {
    session_start();
    
    // Ensure the coordinator is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $coordinatorUserId = $_SESSION['user_id'];

    // Fetch the department ID for the logged-in coordinator
    $deptQuery = "SELECT department_id FROM users WHERE user_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }
    $deptStmt->bind_param('i', $coordinatorUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result()->fetch_assoc();
    
    if (!$deptResult) {
        throw new Exception('Coordinator account does not have a linked department.');
    }
    $departmentId = $deptResult['department_id'];

    // Handle search and pagination parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Calculate pagination offsets
    $start = ($page - 1) * $length;

    // Query: Fetch students only from the same department as the logged-in coordinator
    $sql = "
        SELECT 
            users.user_id AS userID,
            CONCAT(users.last_name, ' ', users.first_name) AS name,
            department.department_name AS department,
            users.email AS email,
            supervisor.last_name AS supervisor_last_name,
            supervisor.first_name AS supervisor_first_name,
            supervisor.company AS supervisor_company,
            supervisor.company_address AS supervisor_company_address
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        LEFT JOIN student_supervisor ON users.user_id = student_supervisor.student_id
        LEFT JOIN users AS supervisor ON student_supervisor.supervisor_id = supervisor.user_id
        WHERE users.user_type = 'Student'
          AND users.department_id = ? 
          AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?
        LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Failed to prepare the query.');
    }
    $searchTerm = "%$search%";
    $stmt->bind_param('isii', $departmentId, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate the rows dynamically
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['name']) ?: '--';
        $department = htmlspecialchars($row['department']) ?: '--';
        $email = htmlspecialchars($row['email']) ?: '--';
        $supervisorName = htmlspecialchars($row['supervisor_first_name'] . ' ' . $row['supervisor_last_name']) ?: '--';
        $supervisorCompany = htmlspecialchars($row['supervisor_company']) ?: '--';
        $supervisorAddress = htmlspecialchars($row['supervisor_company_address']) ?: '--';

        $html .= '<tr>';
        $html .= "<td>{$name}</td>";
        $html .= "<td>{$department}</td>";
        $html .= "<td>{$email}</td>";
        $html .= "<td>{$supervisorName}</td>";
        $html .= "<td>{$supervisorCompany}</td>";
        $html .= "<td>{$supervisorAddress}</td>";
        $html .= '<td>
            <button class="btn btn-success btn-sm open-modal-btn" data-bs-toggle="modal" data-bs-target="#assignSupervisorModal"
                    data-user-id="' . $row['userID'] . '">Assign</button>
        </td>';
        $html .= '</tr>';
    }

    // Total count query for proper pagination
    $countSql = "
        SELECT COUNT(*) AS total 
        FROM users 
        WHERE user_type = 'Student'
          AND department_id = ? 
          AND CONCAT_WS(' ', first_name, last_name, username, email) LIKE ?";
    
    $countStmt = $conn->prepare($countSql);
    if (!$countStmt) {
        throw new Exception('Failed to prepare count query.');
    }
    $countStmt->bind_param('is', $departmentId, $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $totalRecords = $countResult['total'];

    // Calculate pagination
    $totalPages = ceil($totalRecords / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item ' . ($i === $page ? 'active' : '') . '">
            <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }

    // Return the JSON response
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
