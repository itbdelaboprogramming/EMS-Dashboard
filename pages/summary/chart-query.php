<?php
include("../../database/config.php");

$dataCurrent[] = array();

$status = $_POST["status"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$interval = $_POST["interval"];
$utility = $_POST["utility"];

$query;
$timeInterval;

if ($interval === "custom") {
    $startDate = $startDate;
    $endDate = $endDate;
    $timeInterval = "time BETWEEN '$startDate' AND '$endDate'";
} else {
    // Tambahkan kode untuk mengambil data dengan interval daily, weekly, dan monthly dari database
    if ($interval === "daily") {
        $timeInterval = "DATE(time) = CURDATE()";
    } elseif ($interval === "weekly") {
        $timeInterval = "YEARWEEK(time) = YEARWEEK(CURDATE())";
    } elseif ($interval === "monthly") {
        $timeInterval = "MONTH(time) = MONTH(CURDATE())";
    } elseif ($interval === "yearly") {
        $timeInterval = "YEAR(`time`) = YEAR(CURDATE())";
    } elseif ($interval === "last_year") {
        $timeInterval = "time >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
    }
}

try {
    if ($utility !== "all") {
        // Build the query
        $query = "SELECT DATE(time) AS tanggal, SUM($status) AS total_$status
        FROM $utility
        WHERE $status IS NOT NULL AND $timeInterval
        GROUP BY DATE(time) ";

        if ($interval === "daily") {
            $query = "SELECT DATE_FORMAT(`time`, '%Y-%m-%d %H') AS tanggal, SUM(`$status`) AS total_$status 
              FROM `$utility` 
              WHERE DATE(`time`) = CURDATE() AND `$status` IS NOT NULL 
              GROUP BY DATE_FORMAT(`time`, '%Y-%m-%d %H')";
        } else if ($interval === "yearly") {
            $query = "SELECT MONTH(`time`) AS tanggal, SUM(`$status`) AS `total_$status`
            FROM `$utility`
            WHERE $timeInterval
            GROUP BY MONTH(`time`)";
        } else {
            $query = "SELECT DATE(time) AS tanggal, SUM($status) AS total_$status
            FROM $utility
            WHERE $timeInterval
            GROUP BY DATE(time) ";
        }

        // Execute the query
        $result = mysqli_query($connect, $query);

        if ($result) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            // Return the result as a JSON object
            echo json_encode($data);
        } else {
            // Return an error message if the query fails
            echo json_encode(['error' => 'Query execution failed: ' . mysqli_error($connect)]);
        }
    } else {
        // Array untuk menyimpan data dari tabel-tabel
        $data = array();

        // Loop untuk mengambil data dari masing-masing tabel
        for ($i = 1; $i <= 8; $i++) {
            $tableName = "tuya_smart_plug_$i";

            $query;

            if ($interval === "daily") {
                $query = "SELECT DATE_FORMAT(`time`, '%Y-%m-%d %H') AS tanggal, SUM(`$status`) AS total_$status 
                          FROM `$tableName` 
                          WHERE DATE(`time`) = CURDATE() AND `$status` IS NOT NULL 
                          GROUP BY DATE_FORMAT(`time`, '%Y-%m-%d %H')";
            } else if ($interval === "yearly") {
                $query = "SELECT MONTH(`time`) AS tanggal, SUM(`$status`) AS `total_$status`
                FROM `$tableName`
                WHERE $timeInterval
                GROUP BY MONTH(`time`)";
            } else {
                $query = "SELECT DATE(time) AS tanggal, SUM($status) AS total_$status
                FROM $tableName
                WHERE $timeInterval
                GROUP BY DATE(time) ";
            }

            $result = $connect->query($query);

            $tableData = array();
            while ($row = $result->fetch_assoc()) {
                $tableData[] = array(
                    "tanggal" => $row['tanggal'],
                    "total_$status" => $row["total_$status"]
                );
            }

            $data[$tableName] = $tableData;
        }

        // Mengubah data menjadi format JSON
        echo json_encode([$data]);
    }
    // Menutup koneksi
    mysqli_close($connect);
} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage();
}
