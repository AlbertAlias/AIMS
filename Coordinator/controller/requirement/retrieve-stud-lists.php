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
    $sql = "SELECT 
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
      AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?
    LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate table rows
    $html = '';
    while ($row = $result->fetch_assoc()) {
        // Check if any value is empty and replace with "N/A" or "--"
        $name = htmlspecialchars($row['name']) ?: '--';
        $department = htmlspecialchars($row['department']) ?: '--';
        $email = htmlspecialchars($row['email']) ?: '--';
        $supervisorName = htmlspecialchars($row['supervisor_first_name'] . ' ' . $row['supervisor_last_name']) ?: '--';
        $supervisorCompany = htmlspecialchars($row['supervisor_company']) ?: '--';
        $supervisorCompanyAddress = htmlspecialchars($row['supervisor_company_address']) ?: '--';

        $html .= '<tr>';
        $html .= '<td>' . $name . '</td>';
        $html .= '<td>' . $department . '</td>';
        $html .= '<td>' . $email . '</td>';
        $html .= '<td>' . $supervisorName . '</td>';
        $html .= '<td>' . $supervisorCompany . '</td>';
        $html .= '<td>' . $supervisorCompanyAddress . '</td>';
        $html .= '<td>
            <button class="btn btn-success btn-sm open-modal-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#assignSupervisorModal"
                    data-user-id="' . $row['userID'] . '">
                Assign
            </button>
            <button class="btn btn-info btn-sm open-modal-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#viewRequirementsModal"
                    data-user-id="' . $row['userID'] . '">
                Requirements
            </button>
        </td>';
        $html .= '</tr>';
    }

    // Query to get total count for pagination
    $totalSql = "SELECT COUNT(*) AS total
         FROM users
         LEFT JOIN department ON users.department_id = department.department_id
         LEFT JOIN student_supervisor ON users.user_id = student_supervisor.student_id
         LEFT JOIN users AS supervisor ON student_supervisor.supervisor_id = supervisor.user_id
         WHERE users.user_type = 'Student'
           AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('s', $searchTerm);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

    // Generate pagination links with a limited display
    $totalPages = ceil($total / $length);
    $pagination = '';
    $maxVisiblePages = 3; // Number of pages to show at a time
    $startPage = max(1, $page - floor($maxVisiblePages / 2));
    $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

    if ($endPage - $startPage + 1 < $maxVisiblePages) {
        $startPage = max(1, $endPage - $maxVisiblePages + 1);
    }

    // First page button
    if ($startPage > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
        if ($startPage > 2) {
            $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    // Main pagination buttons
    for ($i = $startPage; $i <= $endPage; $i++) {
        $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '">';
        $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
        $pagination .= '</li>';
    }

    // Last page button
    if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
            $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
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