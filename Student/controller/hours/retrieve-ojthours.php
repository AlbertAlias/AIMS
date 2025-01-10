<?php 
    header('Content-Type: application/json');
    include '../../../dbconn.php';

    try {
        session_start();
        $student_id = $_SESSION['user_id'];

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $start = ($page - 1) * $length;

        $sql = "
        SELECT 
            ojt_hours.morning_start,
            ojt_hours.lunch_start,
            ojt_hours.lunch_end,
            ojt_hours.afternoon_end,
            ojt_hours.total_hours,
            ojt_hours.file_path,
            ojt_hours.submission_date
        FROM ojt_hours
        WHERE ojt_hours.student_id = ? 
        AND (
            CONCAT(MONTHNAME(ojt_hours.submission_date), ' ', DAY(ojt_hours.submission_date)) LIKE ?
            OR
            CONCAT(DATE_FORMAT(ojt_hours.submission_date, '%b'), ' ', DAY(ojt_hours.submission_date)) LIKE ?
        )
        ORDER BY ojt_hours.submission_date DESC
        LIMIT ?, ?";

        $stmt = $conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('issii', $student_id, $searchTerm, $searchTerm, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();

        $html = '';
        $currentYear = date('Y');

        if ($result->num_rows === 0) {
            $html = '<tr><td colspan="7">No data available</td></tr>';
        } else {
            while ($row = $result->fetch_assoc()) {
                $morningStart = htmlspecialchars($row['morning_start']) ?: '--';
                $lunchStart = htmlspecialchars($row['lunch_start']) ?: '--';
                $lunchEnd = htmlspecialchars($row['lunch_end']) ?: '--';
                $afternoonEnd = htmlspecialchars($row['afternoon_end']) ?: '--';
                $totalHours = htmlspecialchars($row['total_hours']) ?: '--';

                $morningStart = formatTime($morningStart);
                $lunchStart = formatTime($lunchStart);
                $lunchEnd = formatTime($lunchEnd);
                $afternoonEnd = formatTime($afternoonEnd);
                $totalHours = formatTotalHours($totalHours);

                $filePath = htmlspecialchars($row['file_path']) ? '/AIMS/Student/controller/hours/uploads/' . basename($row['file_path']) : '--';

                $submissionDate = htmlspecialchars($row['submission_date']) ?: '--';
                if ($submissionDate !== '--') {
                    $timestamp = strtotime($submissionDate);
                    $month = date('M', $timestamp);
                    $day = date('j', $timestamp);
                    $year = date('Y', $timestamp);
                    $time = date('g:i A', $timestamp);

                    $yearDisplay = ($year == $currentYear) ? '' : ' ' . $year;
                    $submissionDate = $month . ' ' . $day . $yearDisplay . ' ' . $time;
                }

                $html .= '<tr>';
                $html .= '<td>' . $submissionDate . '</td>';
                $html .= '<td>' . $morningStart . '</td>';
                $html .= '<td>' . $lunchStart . '</td>';
                $html .= '<td>' . $lunchEnd . '</td>';
                $html .= '<td>' . $afternoonEnd . '</td>';
                $html .= '<td>' . $totalHours . '</td>';
                $html .= '<td>';
                if ($filePath !== '--') {
                    $html .= '<button class="btn btn-sm btn-primary view-file-button" data-file="' . $filePath . '">View File</button>';
                } else {
                    $html .= '--';
                }
                $html .= '</td>';
                $html .= '</tr>';
            }
        }

        $totalSql = "
        SELECT COUNT(*) AS total
        FROM ojt_hours
        WHERE ojt_hours.student_id = ? 
        AND (CONCAT(MONTHNAME(ojt_hours.submission_date), ' ', DAY(ojt_hours.submission_date)) LIKE ?)";
        
        $totalStmt = $conn->prepare($totalSql);
        $totalStmt->bind_param('is', $student_id, $searchTerm);
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $total = $totalResult->fetch_assoc()['total'];

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
            'start' => ($total > 0) ? $start + 1 : 0,
            'end' => ($total > 0) ? min($start + $length, $total) : 0,
            'total' => $total
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    $stmt->close();
    $totalStmt->close();
    $conn->close();

    function formatTime($time) {
        if ($time === '--') return $time;
        $formattedTime = date('g:i A', strtotime($time));
        return preg_replace('/^0(\d)/', '$1', $formattedTime);
    }

    function formatTotalHours($totalHours) {
        if ($totalHours === '--') return $totalHours;
        return (float)$totalHours == (int)$totalHours ? (int)$totalHours : $totalHours;
    }
?>