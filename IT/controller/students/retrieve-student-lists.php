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
        $sql = "SELECT u.id, u.first_name, u.last_name, d.department_name AS department, s.studentID, u.gender, 
                u.personal_email, u.username
                FROM users u
                JOIN students s ON u.id = s.user_id
                LEFT JOIN departments d ON u.department_id = d.id
                WHERE CONCAT_WS(' ', u.first_name, u.last_name, d.department_name, s.studentID, u.personal_email) LIKE ? 
                LIMIT ?, ?";

        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('sii', $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        // Generate table rows
        $html = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $html .= '<tr>';
                $html .= '<td><input type="checkbox" class="userCheckbox" data-id="' . htmlspecialchars($row['id']) . '"></td>';
                $html .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['department']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['personal_email']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['username']) . '</td>';
                $html .= '</tr>';
            }
        }

        // Calculate start and end for pagination info
        $startIndex = ($page - 1) * $length + 1;  // Set the start index for the current page
        $endIndex = min($startIndex + $length - 1, $result->num_rows + $startIndex - 1); // Calculate end index

        // Continue with pagination logic
        $totalSql = "SELECT COUNT(*) AS total 
                     FROM users u 
                     JOIN students s ON u.id = s.user_id
                     LEFT JOIN departments d ON u.department_id = d.id
                     WHERE CONCAT_WS(' ', u.first_name, u.last_name, d.department_name, s.studentID, u.personal_email) LIKE ?";

        $totalStmt = $conn->prepare($totalSql);
        $totalStmt->bind_param('s', $searchTerm);
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $total = $totalResult->fetch_assoc()['total'];

        // Generate pagination links
        $totalPages = ceil($total / $length);
        $pagination = '';

        if ($total == 0) {
            $pagination = ''; // Clear pagination if no data
        } else {
            for ($i = 1; $i <= $totalPages; $i++) {
                $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '">';
                $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
                $pagination .= '</li>';
            }
        }

        // Return JSON response
        $response = [
            'html' => $html,
            'pagination' => $pagination,
            'start' => $startIndex,
            'end' => $endIndex,
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