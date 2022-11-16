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
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

    $searchValue = mysqli_escape_string($con, $_POST['search']['value']); // Search value

    ## Search 
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " and (fname like '%" . $searchValue . "%' or 
            lname like '%" . $searchValue . "%' or 
            username like'%" . $searchValue . "%' or 
            email like '%" . $searchValue . "%' or 
            address1 like '%" . $searchValue . "%' or 
            country like '%" . $searchValue . "%') ";
    }

    ## Total number of records without filtering
    $sel = mysqli_query($con, "select count(*) as allcount from standard_user");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($con, "select count(*) as allcount from standard_user WHERE 1 " . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from standard_user WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {


        $img = "<img src='../user_img/" . $row['image'] . "'>";
        $action = '<a class="btn btn-primary"
        href="switchback.php?user=' . $row['username'] . '">Switch
        to
        Premium</a>';

        $data[] = array(
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "username" => $row['username'],
            "email" => $row['email'],
            "address1" => $row['address1'],
            "country" => $row['country'],
            "image" => $img,
            "action" => $action
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