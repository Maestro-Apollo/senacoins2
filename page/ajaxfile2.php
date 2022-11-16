<?php
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
$fname = $_POST['user'];

## Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and (cod_cat like '%" . $searchValue . "%' or 
        type_of_coin like '%" . $searchValue . "%' or 
        category like'%" . $searchValue . "%' or
        year like'%" . $searchValue . "%' or
        reference like'%" . $searchValue . "%' or
        sub_category like'%" . $searchValue . "%' or
        description like'%" . $searchValue . "%'
        
        ) ";
}


## Total number of records without filtering
$sel = mysqli_query($con, "select count(*) as allcount from data_tbl WHERE `user` = '$fname' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con, "select count(*) as allcount from data_tbl WHERE `user` = '$fname' " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from data_tbl WHERE  user = '$fname' " . $searchQuery . " limit " . $row . "," . $rowperpage . "   ";
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $content = '
    <div class="container-fluid card-body text-center wow fadeInUp mb-3 p-6"
                        style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius: 10px">
                        <div class="container">
                            <div class="row text-light">
                                <div class="col-md-6 text-left">
                                    <div class="container">
                                        <h3 class="mb-4">Type Of Coin:"' . $row['type_of_coin'] . '"</h3>
                                        <p class="lead">Country:"' . $row['code'] . '"</p>
                                        <p class="lead">Emperor/Period:"' . $row['timeperiod'] . '"</p>
                                        <p class="lead">Year:"' . $row['year'] . '"</p>
                                        <p class="lead">Category:"' . $row['category'] . '"</p>
                                        <p class="lead">Sub-Category:"' . $row['sub_category'] . '"</p>
                                        <p class="lead mt-1">Description:"' . $row['description'] . '"</p>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <img style="width: 35%" class="m-3" src="../coin_img/' . $row['image'] . '"
                                        alt="">
                                    <img style="width: 35%" class="m-3" src="../coin_img/' . $row['image2'] . '"
                                        alt="">
                                    <img style="width: 35%" class="m-3" src="../coin_img/' . $row['image3'] . '"
                                        alt="">
                                    <img style="width: 35%" class="m-3" src="../coin_img/' . $row['image4'] . '"
                                        alt="">
                                    <img style="width: 35%" class="m-3" src="../coin_img/' . $row['image5'] . '"
                                        alt="">



                                </div>
                                <div>
                                    <a class="btn btn-dark" style="text-transform:uppercase"
                                        href="standard_page_data.php?name=' . $row['timeperiod'] . '">
                                        ' . $row['timeperiod'] . ' </a>
                                    <a class="btn btn-dark" style="text-transform:uppercase"
                                        href="countryStandard.php?code=' . $row['code'] . '">
                                        ' . $row['code'] . ' </a>
                                        <a class="btn btn-primary" style="text-transform:uppercase"
                                        href="confirmation_page.php?id=' . $row['id'] . '">
                                        Certificate Request </a>
                                </div>
                            </div>
                        </div>

                    </div>';
    $data[] = array(

        "content" => $content,
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