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
            CONCAT(users.first_name, ' ', users.last_name) AS name,
            department.department_name AS department,
            users.student_id AS studentID,
            users.email AS email
        FROM users
        LEFT JOIN department ON users.department_id = department.department_id
        WHERE users.user_type = 'Student'
          AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.student_id, users.email) LIKE ?
        LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('sii', $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        // Generate table rows
        $html = '';
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['department']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
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
             WHERE users.user_type = 'Student'
               AND CONCAT_WS(' ', users.first_name, users.last_name, department.department_name, users.student_id, users.email) LIKE ?";
        $totalStmt = $conn->prepare($totalSql);
        $totalStmt->bind_param('s', $searchTerm);
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $total = $totalResult->fetch_assoc()['total'];

        // Generate pagination links
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
        echo json_encode(['error' => $e->getMessage()]);
    }

    $stmt->close();
    $totalStmt->close();
    $conn->close();
?>