<?php
include 'config.php';

$request = 1;
if (isset($_POST['request'])) {
    $request = $_POST['request'];
}

// DataTable data
if ($request == 1) {
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = 'desc'; // asc or desc

    $searchValue = mysqli_escape_string($con, $_POST['search']['value']); // Search value

    ## Search 
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " and (type_of_coin like '%" . $searchValue . "%' or 
            year like'%" . $searchValue . "%' or 
            description like '%" . $searchValue . "%' or 
            category like '%" . $searchValue . "%' or 
            sub_category like '%" . $searchValue . "%' or 
           
            reference like '%" . $searchValue . "%' or 
            timeperiod like '%" . $searchValue . "%' or 
            code like '%" . $searchValue . "%' or 
            created like '%" . $searchValue . "%')";
    }

    ## Total number of records without filtering
    $sel = mysqli_query($con, "select count(*) as allcount from data_tbl");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($con, "select count(*) as allcount from data_tbl WHERE 1 " . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from data_tbl WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {


        $img = "<a target='__blank' href='coinimg.php?id=" . $row['id'] . "'><img src='../coin_img/" . $row['image'] . "'></a>";


        $data[] = array(
            "type_of_coin" => $row['type_of_coin'],
            "year" => $row['year'],

            "description" => $row['description'],
            "category" => $row['category'],
            "sub_category" => $row['sub_category'],

            "reference" => $row['reference'],
            "timeperiod" => $row['timeperiod'],

            "code" => $row['code'],

            "img" => $img,
            "created" => $row['created'],


        );
    }

    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
    exit;
}