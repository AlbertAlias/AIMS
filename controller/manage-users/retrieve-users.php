<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include '../../dbconn.php';

    $draw = isset($_POST['draw']) ? $_POST['draw'] : 1;  // Provide a default value for draw
    $row = isset($_POST['start']) ? $_POST['start'] : 0;
    $rowperpage = isset($_POST['length']) ? $_POST['length'] : 10; // Rows display per page

    // Check if 'order' is set and not empty
    $columnIndex = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0; // Column index
    $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : 'firstname'; // Column name
    $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // asc or desc
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search value

    // Search query
    $searchQuery = "";
    if ($searchValue != '') {
        $searchQuery = " AND (firstname LIKE '%".$searchValue."%' 
                            OR lastname LIKE '%".$searchValue."%' 
                            OR department LIKE '%".$searchValue."%' 
                            OR studentID LIKE '%".$searchValue."%' 
                            OR company LIKE '%".$searchValue."%' 
                            OR email LIKE '%".$searchValue."%' 
                            OR user_type LIKE '%".$searchValue."%') ";
    }

    // Total number of records without filtering
    $totalRecordsQuery = "SELECT COUNT(*) AS totalcount FROM users_acc";
    $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
    $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['totalcount'];

    // Total number of records with filtering
    $totalRecordwithFilterQuery = "SELECT COUNT(*) AS totalcountfiltered FROM users_acc WHERE 1 ".$searchQuery;
    $totalRecordwithFilterResult = mysqli_query($conn, $totalRecordwithFilterQuery);
    $totalRecordwithFilter = mysqli_fetch_assoc($totalRecordwithFilterResult)['totalcountfiltered'];

    // Fetch records
    $empQuery = "SELECT * FROM users_acc WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
    $empRecords = mysqli_query($conn, $empQuery);

    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "firstname" => $row['firstname'],
            "lastname" => $row['lastname'],
            "department" => $row['department'],
            "studentID" => $row['studentID'],
            "company" => $row['company'],
            "email" => $row['email'],
            "password" => $row['password'],
            "user_type" => $row['user_type'],
            "action" => '<button class="btn btn-primary edit-btn" data-id="'.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger delete-btn" data-id="'.$row['id'].'"><i class="fa-solid fa-trash"></i></button>'
        );
    }

    // Prepare response
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $totalRecordwithFilter,
        "data" => $data
    );

    echo json_encode($response);
?>