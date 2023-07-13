<?php
include('../../database/config.php');

// $table = $_POST['smartplug'];
$totalElectricity = 0;
$totalCurrent = 0;
$totalCarbon = 0;

$dataCurrent[] = array();
$dataElectricity[] = array();
$dataCarbon = array();

try {
    $query;
    $timeInterval;

    // if ($interval == 'custom') {
    $startDate;
    $endDate;
    $utility = $_POST['utility'];
    $interval = $_POST['interval'];

    if ($interval === "custom") {
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $timeInterval = "time BETWEEN '$startDate' AND '$endDate'";
    } else {
        // Tambahkan kode untuk mengambil data dengan interval daily, weekly, dan monthly dari database
        if ($interval === "daily") {
            $timeInterval = "DATE(time) = CURDATE()";
        } elseif ($interval === "weekly") {
            $timeInterval = "YEARWEEK(time) = YEARWEEK(CURDATE())";
        } elseif ($interval === "monthly") {
            $timeInterval = "MONTH(time) = MONTH(CURDATE())";
        }
    }

    if ($utility !== "all") {
        $query = "SELECT SUM(current) AS total_current,SUM(electricity) AS total_electricity,SUM(carbon_emission) AS total_carbon  FROM $utility WHERE $timeInterval";
        // Execute the query
        $result = $connect->query($query);

        // Fetch the result
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Fetch the result
                $total_current = $row['total_current'];
                $total_carbon = $row['total_carbon'];
                $total_electricity = $row['total_electricity'];

                // Return the result as a JSON object
                echo json_encode(['total_current' => $total_current, 'total_electricity' => $total_electricity, 'total_carbon' => $total_carbon]);
            }
        } else {
            throw new Exception("Error executing query: " . $connect->error);
        }
    } else {
        for ($i = 1; $i < 9; $i++) {
            $util = "tuya_smart_plug_$i";
            $query = "SELECT SUM(current) AS total_current,SUM(electricity) AS total_electricity,SUM(carbon_emission) AS total_carbon  FROM $util WHERE $timeInterval";
            $result = $connect->query($query);
            // Membuat array untuk menyimpan data

            // Fetch the result
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    // Fetch the result
                    $totalCurrent +=  $row['total_current'];
                    $totalCarbon += $row['total_carbon'];
                    $totalElectricity += $row['total_electricity'];
                }
            } else {
                throw new Exception("Error executing query: " . $connect->error);
            }
        }
        // Return the result as a JSON object
        echo json_encode(['total_current' => $totalCurrent, 'total_electricity' => $totalElectricity, 'total_carbon' => $totalCarbon]);
    }

    $connect->close();
} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage();
}
