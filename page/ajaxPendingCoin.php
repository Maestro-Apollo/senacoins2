<?php
session_start();
$username = '"' . $_SESSION['name'] . '"';
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
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

    $searchValue = mysqli_escape_string($con, $_POST['search']['value']); // Search value

    ## Search 
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " and ( 
            type_of_coin like '%" . $searchValue . "%' or 
            year like'%" . $searchValue . "%' or 
            description like '%" . $searchValue . "%' or 
            category like '%" . $searchValue . "%' or 
            sub_category like '%" . $searchValue . "%' or 
            reference like '%" . $searchValue . "%' or
            historical period like '%" . $searchValue . "%' or 
            country like '%" . $searchValue . "%')";
    }

    ## Total number of records without filtering
    $sel = mysqli_query($con, "select count(*) as allcount from request  where request.user = " . $username);
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($con, "select count(*) as allcount from request  where request.user = " . $username . '' . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from request  where request.user = " . $username . '' . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {


        $img = "<img src='../coin_img/" . $row['image'] . "'>";



        $data[] = array(
            "type_of_coin" => $row['type_of_coin'],
            "year" => $row['year'],
            "description" => $row['description'],
            "category" => $row['category'],
            "reference" => $row['reference'],
            "sub_category" => $row['sub_category'],
            "historical period" => $row['historical period'],

            "country" => $row['country'],

            "img" => $img,


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