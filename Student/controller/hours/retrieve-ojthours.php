<?php 
    header('Content-Type: application/json');

    include '../../../dbconn.php';

    try {
        // Get the logged-in user's ID from session
        session_start();
        $student_id = $_SESSION['user_id'];  // Assuming the student ID is stored in session

        // Get parameters for pagination
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Calculate pagination
        $start = ($page - 1) * $length;

        // Query to get filtered and paginated data from the ojt_hours table, ordered by submission_date DESC
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

        // Generate table rows
        $html = '';
        $currentYear = date('Y'); // Current year to compare with submission year
        while ($row = $result->fetch_assoc()) {

            // Convert the time fields from military format to 12-hour format with AM/PM
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

            // Format submission date
            $submissionDate = htmlspecialchars($row['submission_date']) ?: '--';
            if ($submissionDate !== '--') {
                // Convert to a timestamp
                $timestamp = strtotime($submissionDate);
                $month = date('M', $timestamp); // Shortened month
                $day = date('j', $timestamp); // Day of the month
                $year = date('Y', $timestamp); // Year
                $time = date('g:i A', $timestamp); // Non-military time

                // Shorten year if it's not the current year
                $yearDisplay = ($year == $currentYear) ? '' : ' ' . $year;

                // Final formatted submission date
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

        // Fetch the sum of total hours
        $totalHoursSql = "
        SELECT SUM(CAST(ojt_hours.total_hours AS DECIMAL(10,2))) AS total_hours_sum
        FROM ojt_hours
        WHERE ojt_hours.student_id = ? 
        AND (CONCAT(MONTHNAME(ojt_hours.submission_date), ' ', DAY(ojt_hours.submission_date)) LIKE ?)";
        
        $totalHoursStmt = $conn->prepare($totalHoursSql);
        $totalHoursStmt->bind_param('is', $student_id, $searchTerm);
        $totalHoursStmt->execute();
        $totalHoursResult = $totalHoursStmt->get_result();
        $totalHoursSum = $totalHoursResult->fetch_assoc()['total_hours_sum'];

        // Ensure total_hours_sum is a whole number if it's an integer
        if ($totalHoursSum == floor($totalHoursSum)) {
            $totalHoursSum = (int) $totalHoursSum; // Convert to integer if no decimal part
        }

        // Fetch total count for pagination
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
            'total' => $total,
            'total_hours_sum' => $totalHoursSum
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    $stmt->close();
    $totalStmt->close();
    $conn->close();

    // Helper function to format the time to 12-hour format
    function formatTime($time) {
        if ($time === '--') return $time;
        // Convert military time to 12-hour format
        $formattedTime = date('g:i A', strtotime($time));
        // Remove leading zero if it's a whole number
        return preg_replace('/^0(\d)/', '$1', $formattedTime);
    }

    // Helper function to format total hours
    function formatTotalHours($totalHours) {
        if ($totalHours === '--') return $totalHours;
        // Remove leading zero for whole numbers in total hours
        return (float)$totalHours == (int)$totalHours ? (int)$totalHours : $totalHours;
    }
?>