<?php
    require '../../../dbconn.php';

    $response = [
        'success' => false,
        'data' => [],
        'message' => ''
    ];

    try {
        $sql = "SELECT DISTINCT company FROM users WHERE company IS NOT NULL";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response['data'][] = $row;
            }
            $response['success'] = true;
        } else {
            $response['message'] = "No companies found.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
?>