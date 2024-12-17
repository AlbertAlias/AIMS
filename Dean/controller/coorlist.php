<?php
// header('Content-Type: application/json');
// include '../../dbconn.php';

// try {
//     session_start();
//     if (!isset($_SESSION['user_id'])) {
//         throw new Exception('Unauthorized access. Please log in.');
//     }

//     $deanUserId = $_SESSION['user_id'];

//     // Fetch the departments handled by the dean
//     $deptQuery = "
//         SELECT d.department_id, d.department_name
//         FROM department d
//         WHERE d.dean_id = ?";
//     $deptStmt = $conn->prepare($deptQuery);
//     if (!$deptStmt) {
//         throw new Exception('Failed to prepare department query.');
//     }
//     $deptStmt->bind_param('i', $deanUserId);
//     $deptStmt->execute();
//     $deptResult = $deptStmt->get_result();
//     $departments = $deptResult->fetch_all(MYSQLI_ASSOC);

//     if (empty($departments)) {
//         throw new Exception('No departments found for this dean.');
//     }

//     $data = [];
//     foreach ($departments as $dept) {
//         $departmentId = $dept['department_id'];
//         $departmentName = $dept['department_name'];

//         // Fetch coordinators for this department and their student count
//         $coordinatorQuery = "
//             SELECT u.first_name AS coordinator_first_name, u.last_name AS coordinator_last_name,
//                    COUNT(s.user_id) AS total_students
//             FROM coordinator c
//             JOIN users u ON c.user_id = u.user_id
//             LEFT JOIN users s ON s.department_id = ? AND s.user_type = 'Student'
//             WHERE u.department_id = ?
//             GROUP BY c.user_id";
//         $coordinatorStmt = $conn->prepare($coordinatorQuery);
//         if (!$coordinatorStmt) {
//             throw new Exception('Failed to prepare coordinator query.');
//         }
//         $coordinatorStmt->bind_param('ii', $departmentId, $departmentId);
//         $coordinatorStmt->execute();
//         $coordinatorResult = $coordinatorStmt->get_result();

//         while ($row = $coordinatorResult->fetch_assoc()) {
//             $data[] = [
//                 'department_name' => $departmentName,
//                 'coordinator_first_name' => $row['coordinator_first_name'],
//                 'coordinator_last_name' => $row['coordinator_last_name'],
//                 'total_students' => $row['total_students']
//             ];
//         }
//     }

//     echo json_encode(['data' => $data]);
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }
// $conn->close();



// goods to


// header('Content-Type: application/json');
// include '../../dbconn.php';

// try {
//     session_start();
//     if (!isset($_SESSION['user_id'])) {
//         throw new Exception('Unauthorized access. Please log in.');
//     }

//     // Pagination & search logic
//     $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
//     $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
//     $search = isset($_GET['search']) ? trim($_GET['search']) : '';

//     $start = ($page - 1) * $length;

//     // Query to fetch only Coordinators
//     $query = "
//         SELECT 
//             user_id, 
//             first_name, 
//             last_name, 
//             department_id
//         FROM users
//         WHERE user_type = 'Coordinator'
//         AND CONCAT_WS(' ', first_name, last_name) LIKE ?
//         LIMIT ?, ?";
    
//     $stmt = $conn->prepare($query);
//     $searchTerm = "%$search%";
//     $stmt->bind_param('sii', $searchTerm, $start, $length);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $html = '';
//     while ($row = $result->fetch_assoc()) {
//         $html .= '<tr>';
//         $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['department_id']) . '</td>';
//         $html .= '<td>' . '---' . '</td>'; // Placeholder
//         $html .= '</tr>';
//     }

//     $countQuery = "
//         SELECT COUNT(*) AS total
//         FROM users
//         WHERE user_type = 'Coordinator'
//         AND CONCAT_WS(' ', first_name, last_name) LIKE ?";
    
//     $countStmt = $conn->prepare($countQuery);
//     $countStmt->bind_param('s', $searchTerm);
//     $countStmt->execute();
//     $countResult = $countStmt->get_result()->fetch_assoc();
//     $totalRecords = $countResult['total'];

//     $totalPages = ceil($totalRecords / $length);
//     $pagination = '';
//     for ($i = 1; $i <= $totalPages; $i++) {
//         $pagination .= "<li class='page-item " . ($i === $page ? 'active' : '') . "'>
//             <a class='page-link' href='#' data-page='{$i}'>{$i}</a>
//         </li>";
//     }

//     echo json_encode([
//         'html' => $html,
//         'pagination' => $pagination,
//         'start' => $start + 1,
//         'end' => min($start + $length, $totalRecords),
//         'total' => $totalRecords
//     ]);
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }






// header('Content-Type: application/json');
// include '../../dbconn.php';

// try {
//     session_start();
//     if (!isset($_SESSION['user_id'])) {
//         throw new Exception('Unauthorized access. Please log in.');
//     }

//     $dean_id = $_SESSION['user_id']; // Logged-in dean's ID

//     // Step 1: Fetch the logged-in dean's department_id
//     $deptQuery = "
//         SELECT department_id 
//         FROM dean_department 
//         WHERE dean_id = ?";
    
//     $deptStmt = $conn->prepare($deptQuery);
//     $deptStmt->bind_param('i', $dean_id);
//     $deptStmt->execute();
//     $deptResult = $deptStmt->get_result();

//     if ($deptResult->num_rows === 0) {
//         throw new Exception('No department associated with the logged-in dean.');
//     }

//     $deanDept = $deptResult->fetch_assoc();
//     $department_id = $deanDept['department_id']; // Dean's department_id

//     // Debugging Step: Log the fetched department_id
//     error_log("Dean's Department ID: " . $department_id);

//     // Pagination & search logic
//     $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
//     $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
//     $search = isset($_GET['search']) ? trim($_GET['search']) : '';

//     $start = ($page - 1) * $length;

//     // Step 2: Query Coordinators in the logged-in dean's department
//     $query = "
//         SELECT 
//             user_id, 
//             first_name, 
//             last_name
//         FROM users
//         WHERE user_type = 'Coordinator'
//         AND department_id = ?
//         AND (CONCAT_WS(' ', first_name, last_name) LIKE ? OR ? = '')
//         LIMIT ?, ?";
    
//     $stmt = $conn->prepare($query);
//     $searchTerm = "%$search%";

//     $stmt->bind_param('issii', $department_id, $searchTerm, $searchTerm, $start, $length);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $html = '';
//     while ($row = $result->fetch_assoc()) {
//         $html .= '<tr>';
//         $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
//         $html .= '</tr>';
//     }

//     // Debugging Step: Log number of coordinators fetched
//     error_log("Number of coordinators fetched: " . $result->num_rows);

//     // Count total coordinators in the same department
//     $countQuery = "
//         SELECT COUNT(*) AS total
//         FROM users
//         WHERE user_type = 'Coordinator'
//         AND department_id = ?
//         AND (CONCAT_WS(' ', first_name, last_name) LIKE ? OR ? = '')";
    
//     $countStmt = $conn->prepare($countQuery);
//     $countStmt->bind_param('iss', $department_id, $searchTerm, $searchTerm);
//     $countStmt->execute();
//     $countResult = $countStmt->get_result()->fetch_assoc();
//     $totalRecords = $countResult['total'];

//     $totalPages = ceil($totalRecords / $length);

//     $pagination = '';
//     for ($i = 1; $i <= $totalPages; $i++) {
//         $pagination .= "<li class='page-item " . ($i === $page ? 'active' : '') . "'>
//             <a class='page-link' href='#' data-page='{$i}'>{$i}</a>
//         </li>";
//     }

//     echo json_encode([
//         'html' => $html,
//         'pagination' => $pagination,
//         'start' => $start + 1,
//         'end' => min($start + $length, $totalRecords),
//         'total' => $totalRecords
//     ]);
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }



header('Content-Type: application/json');
include '../../dbconn.php';

try {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access. Please log in.');
    }

    $deanUserId = $_SESSION['user_id'];

    // Fetch departments managed by the logged-in dean
    $deptQuery = "SELECT department_id FROM dean_department WHERE dean_id = ?";
    $deptStmt = $conn->prepare($deptQuery);
    if (!$deptStmt) {
        throw new Exception('Failed to prepare department query.');
    }

    $deptStmt->bind_param('i', $deanUserId);
    $deptStmt->execute();
    $deptResult = $deptStmt->get_result();

    $departmentIds = [];
    while ($row = $deptResult->fetch_assoc()) {
        $departmentIds[] = $row['department_id'];
    }

    if (empty($departmentIds)) {
        throw new Exception('No departments assigned to the logged-in dean.');
    }

    // Convert department IDs into a comma-separated string for SQL queries
    $departmentIdsStr = implode(',', $departmentIds);

    // Handle pagination and search parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $length = isset($_GET['length']) ? max(1, intval($_GET['length'])) : 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $start = ($page - 1) * $length;

    // Fetch only coordinators in the departments managed by the logged-in dean
    $coordinatorQuery = "
        SELECT 
            u.user_id, 
            u.first_name, 
            u.last_name, 
            u.department_id,
            d.department_name
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Coordinator'
        AND u.department_id IN ($departmentIdsStr)
        AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
        LIMIT ?, ?";
    
    $stmt = $conn->prepare($coordinatorQuery);
    if (!$stmt) {
        throw new Exception('Failed to prepare coordinator query.');
    }

    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for table rows
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['department_id']) . '</td>';
        $html .= '</tr>';
    }

    // Fetch total number of coordinators for pagination
    $countQuery = "
        SELECT COUNT(*) AS total
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        WHERE u.user_type = 'Coordinator'
        AND u.department_id IN ($departmentIdsStr)
        AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
    
    $countStmt = $conn->prepare($countQuery);
    if (!$countStmt) {
        throw new Exception('Failed to prepare total count query.');
    }

    $countStmt->bind_param('s', $searchTerm);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    $totalRecords = $countResult['total'];

    // Handle pagination calculation
    $totalPages = ceil($totalRecords / $length);
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= "<li class='page-item " . ($i === $page ? 'active' : '') . "'>
            <a class='page-link' href='#' data-page='{$i}'>{$i}</a>
        </li>";
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
