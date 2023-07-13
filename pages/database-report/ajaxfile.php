<?php
include("../../database/config.php");

$tablesSelected = $_GET['selectedOption'];

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


## Search 
$searchQuery = " ";

if($searchValue != ''){
	$searchQuery .= " and (voltage like '%".$searchValue."%' or 
        time like '%".$searchValue."%' or 
        power like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($connect,"select count(*) as allcount from tuya_smart_plug_$tablesSelected");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($connect,"select count(*) as allcount from tuya_smart_plug_$tablesSelected WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from tuya_smart_plug_$tablesSelected WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    		"id"=>$row['id'],
    		"time"=>$row['time'],
    		"voltage"=>$row['voltage'],
    		"current"=>$row['current'],
    		"power"=>$row['power']
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
