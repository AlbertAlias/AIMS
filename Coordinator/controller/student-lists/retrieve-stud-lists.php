<?php
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    try {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized access. Please log in.');
        }

        $coordinatorUserId = $_SESSION['user_id'];

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

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $start = ($page - 1) * $length;

        $sql = "
        SELECT 
            users.user_id AS userID,
            CONCAT(users.last_name, ' ', users.first_name) AS name,
            department.department_name AS department,
            users.email AS email,
            supervisor.last_name AS supervisor_last_name,
            supervisor.first_name AS supervisor_first_name,
            supervisor.company AS supervisor_company,
            supervisor.company_address AS supervisor_company_address,
            COALESCE(ce.total_grade, NULL) AS coordinator_grade,
            COALESCE(se.total_grade, NULL) AS supervisor_grade,
            (COALESCE(ce.total_grade, 0) + COALESCE(se.total_grade, 0)) AS final_grade
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        LEFT JOIN student_supervisor ON users.user_id = student_supervisor.student_id
        LEFT JOIN users AS supervisor ON student_supervisor.supervisor_id = supervisor.user_id
        LEFT JOIN coordinator_evaluations AS ce ON ce.student_id = users.user_id
        LEFT JOIN supervisor_evaluations AS se ON se.student_id = users.user_id
        WHERE users.user_type = 'Student'
        AND users.department_id = ? 
        AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.email) LIKE ?
        LIMIT ?, ?";
        
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('isii', $departmentId, $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        $html = '';
        if ($result->num_rows === 0) {
            $html = '<tr><td colspan="8" style="text-align: center;">No data available</td></tr>';
        } else {
            while ($row = $result->fetch_assoc()) {
                $name = htmlspecialchars($row['name']) ?: '--';
                $department = htmlspecialchars($row['department']) ?: '--';
                $email = htmlspecialchars($row['email']) ?: '--';
                $supervisorName = htmlspecialchars($row['supervisor_first_name'] . ' ' . $row['supervisor_last_name']) ?: '--';
                $supervisorCompany = htmlspecialchars($row['supervisor_company']) ?: '--';
                $supervisorAddress = htmlspecialchars($row['supervisor_company_address']) ?: '--';
                $finalGrade = $row['final_grade'] == 0 || is_null($row['final_grade']) ? '--' : htmlspecialchars($row['final_grade']);
    
                $html .= '<tr>';
                $html .= "<td>{$name}</td>";
                $html .= "<td>{$department}</td>";
                $html .= "<td>{$email}</td>";
                $html .= "<td>{$supervisorName}</td>";
                $html .= "<td>{$supervisorCompany}</td>";
                $html .= "<td>{$supervisorAddress}</td>";
                $html .= "<td>{$finalGrade}</td>";
                $html .= '<td>
                            <button class="btn btn-success btn-sm open-modal-btn" data-bs-toggle="modal" 
                                data-bs-target="#assignSupervisorModal" data-user-id="' . $row['userID'] . '">Assign
                            </button>
                            <button class="btn btn-primary btn-sm open-ojthours-btn" data-bs-toggle="modal" data-bs-target="#ojthoursModal" data-user-id="' . $row['userID'] . '">View Hours</button>
                            <button class="btn btn-warning btn-sm open-evaluate-btn" onclick="evaluateStudent(' . $row['userID'] . ')">Evaluate</button>
                        </td>';
                $html .= '</tr>';
            }
        }

        $countSql = "
        SELECT COUNT(*) AS total 
        FROM users 
        WHERE user_type = 'Student'
        AND department_id = ? 
        AND CONCAT_WS(' ', first_name, last_name, email) LIKE ?";
        
        $countStmt = $conn->prepare($countSql);
        $countStmt->bind_param('is', $departmentId, $searchTerm);
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
