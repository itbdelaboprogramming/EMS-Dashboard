<?php
include('../../../database/config.php');

$status_1 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 2');
$status_2 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 2');
$status_3 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 2');
$status_4 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 2');
$status_5 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 2');
$status_6 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 2');
$status_7 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 2');
$status_8 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 2');

$statusArray = array();

function statusChanger($id, $voltage, $current, $statusId)
{
    if ($id % 2 != 0) {
        if ($voltage > 0) {
            if ($current > 0) {
                return "Online";
            } else {
                return "Idle";
            }
        } else {
            return "Offline";
        }
    }
}

function addStatus($statusId, $status)
{
    global $statusArray;
    $statusArray["STATUS_$statusId"] = array(
        'status' => $status,
    );
}

while ($row_1 = mysqli_fetch_array($status_1)) {
    $id_1 = $row_1['id'];
    $current_1 = $row_1['current'];
    $voltage_1 = $row_1['voltage'];
    $smartplug_number = 1;
    $status = statusChanger($id_1, $voltage_1, $current_1, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_2 = mysqli_fetch_array($status_2)) {
    $id_2 = $row_2['id'];
    $current_2 = $row_2['current'];
    $voltage_2 = $row_2['voltage'];
    $smartplug_number = 2;
    $status = statusChanger($id_2, $voltage_2, $current_2, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_3 = mysqli_fetch_array($status_3)) {
    $id_3 = $row_3['id'];
    $current_3 = $row_3['current'];
    $voltage_3 = $row_3['voltage'];
    $smartplug_number = 3;
    $status = statusChanger($id_3, $voltage_3, $current_3, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_4 = mysqli_fetch_array($status_4)) {
    $id_4 = $row_4['id'];
    $current_4 = $row_4['current'];
    $voltage_4 = $row_4['voltage'];
    $smartplug_number = 4;
    $status = statusChanger($id_4, $voltage_4, $current_4, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_5 = mysqli_fetch_array($status_5)) {
    $id_5 = $row_5['id'];
    $current_5 = $row_5['current'];
    $voltage_5 = $row_5['voltage'];
    $smartplug_number = 5;
    $status = statusChanger($id_5, $voltage_5, $current_5, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_6 = mysqli_fetch_array($status_6)) {
    $id_6 = $row_6['id'];
    $current_6 = $row_6['current'];
    $voltage_6 = $row_6['voltage'];
    $smartplug_number = 6;
    $status = statusChanger($id_6, $voltage_6, $current_6, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_7 = mysqli_fetch_array($status_7)) {
    $id_7 = $row_7['id'];
    $current_7 = $row_7['current'];
    $voltage_7 = $row_7['voltage'];
    $smartplug_number = 7;
    $status = statusChanger($id_7, $voltage_7, $current_7, $smartplug_number);
    addStatus($smartplug_number, $status);
}

while ($row_8 = mysqli_fetch_array($status_8)) {
    $id_8 = $row_8['id'];
    $current_8 = $row_8['current'];
    $voltage_8 = $row_8['voltage'];
    $smartplug_number = 8;
    $status = statusChanger($id_8, $voltage_8, $current_8, $smartplug_number);
    addStatus($smartplug_number, $status);
}

// Return the result as a JSON object
echo json_encode($statusArray);
