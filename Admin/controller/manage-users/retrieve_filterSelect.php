<?php
header('Content-Type: application/json');
include '../../../dbconn.php';

try {
    $response = [];
    $filterKey = isset($_GET['filterKey']) ? $_GET['filterKey'] : '';

    switch ($filterKey) {
        case 'Department':
            $result = $conn->query("SELECT DISTINCT department FROM users_acc WHERE department IS NOT NULL AND department != ''");
            $departments = $result->fetch_all(MYSQLI_ASSOC);
            $response['options'] = array_map(function($row) {
                return ['value' => $row['department'], 'text' => $row['department']];
            }, $departments);
            break;
        
        case 'Company':
            $result = $conn->query("SELECT DISTINCT company FROM users_acc WHERE company IS NOT NULL AND company != ''");
            $companies = $result->fetch_all(MYSQLI_ASSOC);
            $response['options'] = array_map(function($row) {
                return ['value' => $row['company'], 'text' => $row['company']];
            }, $companies);
            break;
        
        case 'UserType':
            $result = $conn->query("SELECT DISTINCT user_type FROM users_acc WHERE user_type IS NOT NULL AND user_type != ''");
            $userTypes = $result->fetch_all(MYSQLI_ASSOC);
            $response['options'] = array_map(function($row) {
                return ['value' => $row['user_type'], 'text' => $row['user_type']];
            }, $userTypes);
            break;

        default:
            $response['options'] = [['value' => '', 'text' => 'No data available']];
            break;
    }

    if (empty($response['options'])) {
        $response['options'] = [['value' => '', 'text' => 'No data available']];
    }

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>