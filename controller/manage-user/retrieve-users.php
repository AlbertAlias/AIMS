<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include '../../dbconn.php';

    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    // Search query
    $searchQuery = " ";
    if($searchValue != ''){
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
            "action" => '<button class="btn btn-primary edit-btn" data-id="'.$row['id'].'">Edit</button>
                        <button class="btn btn-danger delete-btn" data-id="'.$row['id'].'">Delete</button>'
        );
    }

    // Prepare response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
?>