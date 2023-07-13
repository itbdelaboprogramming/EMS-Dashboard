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
    } elseif ($interval === "last_year") {
        $timeInterval = "time >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
    }
}

try {
    if ($utility !== "all") {
        // Build the query
        $query = "SELECT SUM($status) AS total_value
        FROM $utility
        WHERE $status IS NOT NULL AND $timeInterval";

        // echo $query;

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
        for ($i = 1; $i <= 9; $i++) {
            $tableName = "tuya_smart_plug_" . $i;

            // Kueri SQL untuk mengambil total_cost dari tabel dalam rentang waktu tertentu
            $query = "SELECT SUM($status) AS total FROM $tableName WHERE $status IS NOT NULL AND $timeInterval";
            $result = $connect->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $datasets[] = $row['total'];
            } else {
                $datasets[] = 0;  // Jika tidak ada data, set nilai total_cost menjadi 0
            }

            // Mengisi data ke dalam array
            $labels[] = $tableName;
        }
        echo json_encode($datasets);
    }
    // Menutup koneksi
    mysqli_close($connect);
} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage();
}
    // Mendapatkan setiap baris data dan menyimpannya dalam array
    // $timeData1 = array();
    // $timeData2 = array();
    // $timeData3 = array();
    // $timeData4 = array();
    // $timeData5 = array();
    // $timeData6 = array();
    // $timeData7 = array();
    // $timeData8 = array();
    // $timeData9 = array();

    // $data1 = array();
    // $data2 = array();
    // $data3 = array();
    // $data4 = array();
    // $data5 = array();
    // $data6 = array();
    // $data7 = array();
    // $data8 = array();
    // $data9 = array();

    // $timeData = array();
    // $data = array();
    // $longData;



    // // Loop untuk mengambil data dari tabel
    // for ($i = 1; $i < 9; $i++) {
    //     $util = "tuya_smart_plug_$i";
    //     // Query SQL untuk mengambil data dari tabel yang ditentukan
    //     $sql = "SELECT time, $status
    //     FROM $util
    //     WHERE $status IS NOT NULL AND $timeInterval
    //     ORDER BY id, time ASC ";

    //     // Menjalankan query
    //     $result = mysqli_query($connect, $sql);

    //     // Periksa jumlah baris hasil query
    //     $numRows = mysqli_num_rows($result);

    //     if ($numRows == 0) {
    //         ${"data$i"}[] = ["0"];
    //     } else {
    //         // Memeriksa apakah query berhasil dijalankan
    //         while ($row = mysqli_fetch_assoc($result)) {

    //             // Menyimpan data yang diminta sesuai dengan nomor tabel
    //             ${"data$i"}[] = $row[$status];
    //             ${"timeData$i"}[] = $row['time'];
    //         }
    //     }
    // }

    // // Menyusun data dalam format yang akan dikirim sebagai respons
    // $data = array(
    //     'timeData1' => $timeData1,
    //     'timeData2' => $timeData2,
    //     'timeData3' => $timeData3,
    //     'timeData4' => $timeData4,
    //     'timeData5' => $timeData5,
    //     'timeData6' => $timeData6,
    //     'timeData7' => $timeData7,
    //     'timeData8' => $timeData6,
    //     'timeData9' => $timeData9,
    //     'data1' => $data1,
    //     'data2' => $data2,
    //     'data3' => $data3,
    //     'data4' => $data4,
    //     'data5' => $data5,
    //     'data6' => $data6,
    //     'data7' => $data7,
    //     'data8' => $data8,
    //     'data9' => $data9,
    // );


    // // Mengembalikan data dalam format JSON
    // echo json_encode($data);