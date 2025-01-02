<?php
    // header('Content-Type: application/json');

    // include '../../dbconn.php';

    // try {
    //     session_start();
    //     if (!isset($_SESSION['user_id'])) {
    //         throw new Exception('Unauthorized access. Please log in.');
    //     }

    //     $supervisorUserId = $_SESSION['user_id'];

    //     // Fetch the supervisor's company from the student_supervisor table
    //     $companyQuery = "
    //         SELECT DISTINCT company 
    //         FROM student_supervisor 
    //         WHERE supervisor_id = ?
    //     ";
    //     $companyStmt = $conn->prepare($companyQuery);
    //     if (!$companyStmt) {
    //         throw new Exception('Failed to prepare company query.');
    //     }
    //     $companyStmt->bind_param('i', $supervisorUserId);
    //     $companyStmt->execute();
    //     $companyResult = $companyStmt->get_result()->fetch_assoc();

    //     if (!$companyResult || empty($companyResult['company'])) {
    //         throw new Exception('Supervisor account does not have a linked company.');
    //     }
    //     $supervisorCompany = $companyResult['company'];

    //     // Get parameters
    //     $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    //     $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    //     $search = isset($_GET['search']) ? $_GET['search'] : '';

    //     // Calculate pagination
    //     $start = ($page - 1) * $length;

    //     // Query to get filtered and paginated data
    //     $sql = "
    //     SELECT u.user_id, u.first_name, u.last_name, u.department_id, u.company, d.department_name
    //     FROM users u
    //     INNER JOIN department d ON u.department_id = d.department_id
    //     INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
    //     WHERE ss.company = ? 
    //       AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
    //     LIMIT ?, ?";
        
    //     $stmt = $conn->prepare($sql);
    //     if (!$stmt) {
    //         throw new Exception('Failed to prepare student query.');
    //     }

    //     $searchTerm = "%$search%";
    //     $stmt->bind_param('ssii', $supervisorCompany, $searchTerm, $start, $length);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     $html = '';
    //     while ($row = $result->fetch_assoc()) {
    //         $first_name = htmlspecialchars($row['first_name']) ?: '--';
    //         $last_name = htmlspecialchars($row['last_name']) ?: '--';
    //         $department_name = htmlspecialchars($row['department_name']) ?: '--';
    //         $user_id = htmlspecialchars($row['user_id']);

    //         $html .= '<tr>';
    //         $html .= '<td>' . $first_name . '</td>';
    //         $html .= '<td>' . $last_name . '</td>';
    //         $html .= '<td>' . $department_name . '</td>';
    //         $html .= '<td><button class="btn btn-primary" onclick="evaluateStudent(' . $user_id . ')">Evaluate</button></td>'; // Add button here
    //         $html .= '</tr>';
    //     }

    //     // Fetch total count for pagination
    //     $totalSql = "
    //     SELECT COUNT(*) AS total 
    //     FROM users u
    //     INNER JOIN department d ON u.department_id = d.department_id
    //     INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
    //     WHERE ss.company = ? 
    //       AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
    //     $totalStmt = $conn->prepare($totalSql);
    //     if (!$totalStmt) {
    //         throw new Exception('Failed to prepare count query.');
    //     }
    //     $totalStmt->bind_param('ss', $supervisorCompany, $searchTerm);
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

    //     // Previous button
    //     if ($page > 1) {
    //         $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
    //     } else {
    //         $pagination .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    //     }

    //     // Main pagination buttons
    //     for ($i = $startPage; $i <= $endPage; $i++) {
    //         $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
    //         $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
    //         $pagination .= '</li>';
    //     }

    //     // Next button
    //     if ($page < $totalPages) {
    //         $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
    //     } else {
    //         $pagination .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
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
?>


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

        // Get parameters
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Calculate pagination
        $start = ($page - 1) * $length;

        // Query to get filtered and paginated data
        $sql = "
        SELECT u.user_id, u.first_name, u.last_name, u.department_id, u.company, d.department_name
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
        WHERE ss.company = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?
        LIMIT ?, ?";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Failed to prepare student query.');
        }

        $searchTerm = "%$search%";
        $stmt->bind_param('ssii', $supervisorCompany, $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        $html = '';
        while ($row = $result->fetch_assoc()) {
            $first_name = htmlspecialchars($row['first_name']) ?: '--';
            $last_name = htmlspecialchars($row['last_name']) ?: '--';
            $department_name = htmlspecialchars($row['department_name']) ?: '--';
            $user_id = htmlspecialchars($row['user_id']);

            // Query to check if the student has already been evaluated
            $evaluationQuery = "
                SELECT COUNT(*) AS evaluation_count
                FROM evaluations
                WHERE student_id = ? AND evaluator_id = ?
            ";
            $evaluationStmt = $conn->prepare($evaluationQuery);
            if (!$evaluationStmt) {
                throw new Exception('Failed to prepare evaluation query.');
            }
            $evaluationStmt->bind_param('ii', $row['user_id'], $supervisorUserId);
            $evaluationStmt->execute();
            $evaluationResult = $evaluationStmt->get_result()->fetch_assoc();
            $evaluationCount = $evaluationResult['evaluation_count'];

            $html .= '<tr>';
            $html .= '<td>' . $first_name . '</td>';
            $html .= '<td>' . $last_name . '</td>';
            $html .= '<td>' . $department_name . '</td>';

            if ($evaluationCount > 0) {
                // If already evaluated, disable the button
                $html .= '<td><button class="btn btn-primary" disabled>Evaluated</button></td>';
            } else {
                // Otherwise, allow evaluation
                $html .= '<td><button class="btn btn-primary" onclick="evaluateStudent(' . $user_id . ')">Evaluate</button></td>';
            }

            $html .= '</tr>';
        }

        // Fetch total count for pagination
        $totalSql = "
        SELECT COUNT(*) AS total 
        FROM users u
        INNER JOIN department d ON u.department_id = d.department_id
        INNER JOIN student_supervisor ss ON u.user_id = ss.student_id
        WHERE ss.company = ? 
          AND CONCAT_WS(' ', u.first_name, u.last_name, u.username, u.email) LIKE ?";
        $totalStmt = $conn->prepare($totalSql);
        if (!$totalStmt) {
            throw new Exception('Failed to prepare count query.');
        }
        $totalStmt->bind_param('ss', $supervisorCompany, $searchTerm);
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

        // Previous button
        if ($page > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
        }

        // Main pagination buttons
        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagination .= '<li class="page-item ' . ($i == $page ? ' active' : '') . '">';
            $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
            $pagination .= '</li>';
        }

        // Next button
        if ($page < $totalPages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
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
