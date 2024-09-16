<?php
require_once '../../../dbconn.php';

$sql = "SELECT id, first_name, last_name FROM coordinators";
$result = $conn->query($sql);

$coordinators = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coordinators[] = $row;
    }
}

echo json_encode($coordinators);
?>
