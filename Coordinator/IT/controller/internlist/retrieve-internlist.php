<?php
header('Content-Type: application/json');

include '../../../../dbconn.php';
session_start();

try {
    // Ensure the user is logged in and is a coordinator
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'Unauthorized access.']);
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Get the department of the logged-in coordinator
    $coordinatorQuery = "SELECT department_id FROM coordinators WHERE user_id = ?";
    $coordinatorStmt = $conn->prepare($coordinatorQuery);
    $coordinatorStmt->bind_param('i', $user_id);
    $coordinatorStmt->execute();
    $coordinatorResult = $coordinatorStmt->get_result();
    $coordinator = $coordinatorResult->fetch_assoc();

    if (!$coordinator) {
        echo json_encode(['error' => 'Coordinator not found.']);
        exit;
    }

    $department_id = $coordinator['department_id'];

    // Get parameters for pagination and filtering
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $start = ($page - 1) * $length;

    // Query to fetch interns in the same department
    $sql = "
        SELECT 
            u.first_name, u.last_name, d.department_name, i.studentID 
        FROM 
            interns i
        JOIN 
            users u ON i.user_id = u.id
        JOIN 
            departments d ON u.department_id = d.id
        WHERE 
            u.department_id = ? AND 
            (CONCAT_WS(' ', u.first_name, u.last_name, i.studentID, d.department_name) LIKE ?)
        LIMIT ?, ?";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $conn->real_escape_string($search) . '%';
    $stmt->bind_param('isii', $department_id, $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate table rows
    $html = '';
    if ($result->num_rows === 0) {
        $html = '<tr><td colspan="6">No data available</td></tr>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['department_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
            $html .= '<td>N/A</td>';
            $html .= '<td><button class="btn btn-sm btn-info">View</button></td>';
            $html .= '</tr>';
        }
    }

    // Query to get total count of matching records
    $totalSql = "
        SELECT 
            COUNT(*) AS total 
        FROM 
            interns i
        JOIN 
            users u ON i.user_id = u.id
        WHERE 
            u.department_id = ? AND 
            (CONCAT_WS(' ', u.first_name, u.last_name, i.studentID) LIKE ?)";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('is', $department_id, $searchTerm);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

    // Generate pagination
    $totalPages = $total > 0 ? ceil($total / $length) : 1;
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
    echo json_encode(['error' => 'Error occurred: ' . $e->getMessage()]);
}
?>