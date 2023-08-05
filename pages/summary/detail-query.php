<?php
include('../../database/config.php');

// $table = $_POST['smartplug'];
$totalElectricity = 0;
$totalCost = 0;
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
        } elseif ($interval === "last_year") {
            $timeInterval = "time >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        }
    }

    if ($utility !== "all") {
        $query = "SELECT SUM(total_cost) AS total_cost,SUM(electricity) AS total_electricity,SUM(carbon_emission) AS total_carbon  FROM $utility WHERE $timeInterval";
        // Execute the query
        $result = $connect->query($query);

        // Fetch the result
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Fetch the result
                $total_cost = $row['total_cost'];
                $total_carbon = $row['total_carbon'];
                $total_electricity = $row['total_electricity'];

                // Return the result as a JSON object
                echo json_encode(['total_cost' => $total_cost, 'total_electricity' => $total_electricity, 'total_carbon' => $total_carbon]);
            }
        } else {
            throw new Exception("Error executing query: " . $connect->error);
        }
    } else {
        $query = "SELECT 
            SUM(total_cost) AS total_cost,
            SUM(electricity) AS total_electricity,
            SUM(carbon_emission) AS total_carbon
          FROM (
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_1 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_2 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_3 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_4 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_5 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_6 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_7 WHERE $timeInterval
            UNION ALL
            SELECT total_cost, electricity, carbon_emission FROM tuya_smart_plug_8 WHERE $timeInterval
          ) AS all_data ";
        $result = $connect->query($query);
        // Membuat array untuk menyimpan data

        // echo ("ini all " . $query);

        // Fetch the result
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Fetch the result
                $totalCost = $row['total_cost'];
                $totalCarbon = $row['total_carbon'];
                $totalElectricity = $row['total_electricity'];
            }
        } else {
            throw new Exception("Error executing query: " . $connect->error);
        }

        // Return the result as a JSON object
        echo json_encode(['total_cost' => $totalCost, 'total_electricity' => $totalElectricity, 'total_carbon' => $totalCarbon]);
    }

    $connect->close();
} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage();
}
