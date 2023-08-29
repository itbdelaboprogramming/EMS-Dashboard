<?php
include('../../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage  ORDER BY id DESC LIMIT 20');


$smartplugs = array();

// Loop through SMARTPLUG 1 to SMARTPLUG 8
for ($i = 1; $i <= 8; $i++) {
    $table_name = 'tuya_smart_plug_' . $i;

    $data = mysqli_query($connect, "SELECT id,total_electricity, voltage, current, power, total_cost, carbon_emission FROM $table_name ORDER BY id DESC LIMIT 20");

    if ($row = mysqli_fetch_array($data)) {
        $smartplugs["SMARTPLUG_$i"] = array(
            'id' => $row['id'],
            'progress_bar' => $row['total_electricity'] * 100,
            'cost' => $row['total_cost'] / 5000,
            'carbon_bar' => $row['carbon_emission'],
            'current' => $row['current'],
            'voltage' => $row['voltage'],
            'power' => $row['power']
        );
    }
}



// Return the result as a JSON object
echo json_encode($smartplugs);
?>
