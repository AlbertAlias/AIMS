<?php
    header('Content-Type: application/json');

    include '../../dbconn.php';

    try {
        // Get parameters
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $filters = isset($_GET['filters']) ? json_decode($_GET['filters'], true) : [];

        // Calculate pagination
        $start = ($page - 1) * $length;

        // Base SQL query
        $sql = "SELECT * FROM users_acc WHERE CONCAT_WS(' ', firstname, lastname, department, studentID, company, email, user_type) LIKE ?";

        // Apply filters
        $filterConditions = [];
        foreach ($filters as $key => $value) {
            if ($value !== '') {
                if ($key == 'UserType') {
                    $filterConditions[] = "user_type LIKE ?";
                } elseif ($key == 'Department') {
                    $filterConditions[] = "department LIKE ?";
                } elseif ($key == 'Company') {
                    $filterConditions[] = "company LIKE ?";
                }
            }
        }

        if (!empty($filterConditions)) {
            $sql .= ' AND ' . implode(' AND ', $filterConditions);
        }

        $sql .= " LIMIT ?, ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $searchTerm = "%$search%";
        $params = [$searchTerm];
        foreach ($filters as $key => $value) {
            if ($value !== '') {
                $params[] = "%$value%";
            }
        }
        $params[] = $start;
        $params[] = $length;

        // Determine the types for binding
        $types = str_repeat('s', count($params) - 2) . 'ii';
        if (!$stmt->bind_param($types, ...$params)) {
            throw new Exception('Bind failed: ' . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        
        // Generate table rows
        $html = '';
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td><input class="form-check-input row-checkbox" type="checkbox" data-id="' . htmlspecialchars($row['id']) . '"></td>';
            $html .= '<td>' . htmlspecialchars($row['firstname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['department']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['company']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $hashedPassword = htmlspecialchars($row['password']);
            $halfLength = ceil(strlen($hashedPassword) / 6);
            $halfPassword = substr($hashedPassword, 0, $halfLength);
            $html .= '<td>' . $halfPassword . '...</td>';
            $html .= '<td>' . htmlspecialchars($row['user_type']) . '</td>';
            $html .= '</tr>';
        }    

        // Query to get total count for pagination
        $totalSql = "SELECT COUNT(*) AS total FROM users_acc WHERE CONCAT_WS(' ', firstname, lastname, department, studentID, company, email, user_type) LIKE ?";
        if (!empty($filterConditions)) {
            $totalSql .= ' AND ' . implode(' AND ', $filterConditions);
        }
        $totalStmt = $conn->prepare($totalSql);

        if (!$totalStmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $totalParams = [$searchTerm];
        foreach ($filters as $key => $value) {
            if ($value !== '') {
                $totalParams[] = "%$value%";
            }
        }

        if (!$totalStmt->bind_param(str_repeat('s', count($totalParams)), ...$totalParams)) {
            throw new Exception('Bind failed: ' . $totalStmt->error);
        }

        if (!$totalStmt->execute()) {
            throw new Exception('Execute failed: ' . $totalStmt->error);
        }

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


// header('Content-Type: application/json');

// include '../../dbconn.php';

// try {
//     // Get parameters
//     $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//     $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
//     $search = isset($_GET['search']) ? $_GET['search'] : '';
    
//     // Calculate pagination
//     $start = ($page - 1) * $length;

//     // Query to get filtered and paginated data
//     $sql = "SELECT * FROM users_acc WHERE CONCAT_WS(' ', firstname, lastname, department, studentID, company, email, user_type) LIKE ? LIMIT ?, ?";
//     $stmt = $conn->prepare($sql);
//     $searchTerm = "%$search%";
//     $stmt->bind_param('sii', $searchTerm, $start, $length);
//     $stmt->execute();
//     $result = $stmt->get_result();
    
//     // Generate table rows
//     $html = '';
//     while ($row = $result->fetch_assoc()) {
//         $html .= '<tr>';
//         $html .= '<td><input class="form-check-input row-checkbox" type="checkbox" data-id="' . htmlspecialchars($row['id']) . '"></td>';
//         $html .= '<td>' . htmlspecialchars($row['firstname']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['department']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['studentID']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['company']) . '</td>';
//         $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
//         $hashedPassword = htmlspecialchars($row['password']);
//         $halfLength = ceil(strlen($hashedPassword) / 6); // Use ceil() to round up if length is odd
//         $halfPassword = substr($hashedPassword, 0, $halfLength); // Extract first half of the password
//         $html .= '<td>' . $halfPassword . '...</td>'; // Display half password with ellipsis
//         $html .= '<td>' . htmlspecialchars($row['user_type']) . '</td>';
//         $html .= '</tr>';
//     }    

    
//     // Query to get total count for pagination
//     $totalSql = "SELECT COUNT(*) AS total FROM users_acc WHERE CONCAT_WS(' ', firstname, lastname, department, studentID, company, email, user_type) LIKE ?";
//     $totalStmt = $conn->prepare($totalSql);
//     $totalStmt->bind_param('s', $searchTerm);
//     $totalStmt->execute();
//     $totalResult = $totalStmt->get_result();
//     $total = $totalResult->fetch_assoc()['total'];
    
//     // Generate pagination links
//     $totalPages = ceil($total / $length);
//     $pagination = '';
//     for ($i = 1; $i <= $totalPages; $i++) {
//         $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '">';
//         $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
//         $pagination .= '</li>';
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