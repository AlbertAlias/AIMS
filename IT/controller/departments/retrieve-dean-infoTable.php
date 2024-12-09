<?php
// Enable error reporting to catch any issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Clear any previous output that might cause issues
ob_clean();

// Set content type to JSON
header('Content-Type: application/json');

include '../../../dbconn.php';

try {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10; // Default length is 10
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $start = ($page - 1) * $length;

    // SQL query to retrieve dean users along with their departments
    $sql = "SELECT u.user_id, u.first_name, u.last_name, d.department_id, d.department_name, u.username
            FROM users u
            LEFT JOIN department d ON u.user_id = d.dean_id  -- Join users with departments based on dean_id
            WHERE u.user_type = 'Dean'  -- Filter for deans only
            AND (CONCAT_WS(' ', u.first_name, u.last_name, d.department_name) LIKE ?)  -- Search term applied to first name, last name, and department name
            LIMIT ?, ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("SQL Error: " . $conn->error);
    }

    // Execute statement and check for errors
    $searchTerm = "%$search%";
    $stmt->bind_param('sii', $searchTerm, $start, $length);
    $stmt->execute();
    if ($stmt->errno) {
        throw new Exception("Execution Error: " . $stmt->error);
    }
    $result = $stmt->get_result();

    $html = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td><input type="checkbox" class="userCheckbox" data-id="' . htmlspecialchars($row['user_id'] ?? '') . '"></td>';
            $html .= '<td class="editable" data-field="first_name">' . htmlspecialchars($row['first_name'] ?? 'Unknown') . '</td>';
            $html .= '<td class="editable" data-field="last_name">' . htmlspecialchars($row['last_name'] ?? 'Unknown') . '</td>';
            $html .= '<td class="editable" data-field="department_name">' . htmlspecialchars($row['department_name'] ?? 'N/A') . '</td>';
            $html .= '<td class="editable" data-field="username">' . htmlspecialchars($row['username'] ?? 'N/A') . '</td>';
            $html .= '<td class="editable" data-field="password">******</td>';
            $html .= '</tr>';
        }
    }

    $startIndex = ($page - 1) * $length + 1;
    $endIndex = min($startIndex + $length - 1, $result->num_rows + $startIndex - 1);
    
    // Query for total count of dean users
    $totalSql = "SELECT COUNT(*) AS total
                 FROM users u
                 LEFT JOIN department d ON u.user_id = d.dean_id
                 WHERE u.user_type = 'Dean'  -- Ensure to count only dean users
                 AND (CONCAT_WS(' ', u.first_name, u.last_name, d.department_name) LIKE ?)";
    
    // Prepare total count query
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->bind_param('s', $searchTerm);
    $totalStmt->execute();
    if ($totalStmt->errno) {
        throw new Exception("Execution Error: " . $totalStmt->error);
    }
    $totalResult = $totalStmt->get_result();
    $total = $totalResult->fetch_assoc()['total'];

    $totalPages = ceil($total / $length);
    $pagination = '';

    if ($total == 0) {
        $pagination = '';
    } else {
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') .'">';
            $pagination .= '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
            $pagination .= '</li>';
        }
    }

    // Prepare the response array
    $response = [
        'html' => $html,
        'pagination' => $pagination,
        'start' => $startIndex,
        'end' => $endIndex,
        'total' => $total
    ];

    // Return JSON response
    echo json_encode($response);

} catch (Exception $e) {
    // Handle errors and return consistent JSON response even if error occurs
    echo json_encode([
        'error' => $e->getMessage(),
        'html' => '',
        'pagination' => '',
        'start' => 0,
        'end' => 0,
        'total' => 0
    ]);
}

// Close the prepared statements and connection
$stmt->close();
$totalStmt->close();
$conn->close();
?>
