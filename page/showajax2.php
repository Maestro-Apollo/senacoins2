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
$codeOther = $_POST['code'];

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
$sel = mysqli_query($con, "select count(*) as allcount from data_tbl WHERE timeperiod = '$codeOther' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con, "select count(*) as allcount from data_tbl WHERE timeperiod = '$codeOther' " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from data_tbl WHERE timeperiod = '$codeOther' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
	$img = "<a target='__blank' href='coinimg.php?id=" . $row['id'] . "'><img src='../coin_img/" . $row['image'] . "'></a>";
	$action = "<a target='__blank' href='admin_update.php?id=" . urlencode($row['id']) . "'class='btn btn-success btn-block'>View</a>
<a href='delete.php?id=" . $row['id'] . "'class='btn btn-danger btn-block'>Delete</a>";

	$data[] = array(
		"cod_cat" => $row['cod_cat'],
		"type_of_coin" => $row['type_of_coin'],
		"year" => $row['year'],
		"description" => $row['description'],
		"image" => $img,
		"category" => $row['category'],
		"sub_category" => $row['sub_category'],
		"rarity" => $row['rarity'],
		"reference" => $row['reference'],
		"bb" => $row['bb'],
		"spl" => $row['spl'],
		"fdc" => $row['fdc'],
		"ecz" => $row['ecz'],
		"action" => $action,


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