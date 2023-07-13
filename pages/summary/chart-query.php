<?php
include("../../database/config.php");
$dataCurrent[] = array();
$dataElectricity[] = array();
$dataCarbon = array();

$query;
$timeInterval;

try {

    // if ($interval == 'custom') {
    $startDate;
    $endDate;
    $interval = $_POST['interval-chart'];

    if ($interval === "custom-chart") {
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

    // Mendapatkan setiap baris data dan menyimpannya dalam array
    $timeData1 = array();
    $timeData2 = array();
    $timeData3 = array();
    $timeData4 = array();
    $timeData5 = array();
    $timeData6 = array();
    $timeData7 = array();
    $timeData8 = array();
    $timeData9 = array();

    $data1 = array();
    $data2 = array();
    $data3 = array();
    $data4 = array();
    $data5 = array();
    $data6 = array();
    $data7 = array();
    $data8 = array();
    $data9 = array();


    $timeData = array();
    $data = array();
    $longData;
    // Loop untuk mengambil data dari tabel
    for ($i = 1; $i < 9; $i++) {
        $util = "tuya_smart_plug_$i";
        // Query SQL untuk mengambil data dari tabel yang ditentukan
        $sql = "SELECT time, voltage
        FROM $util
        WHERE voltage IS NOT NULL AND $timeInterval
        ORDER BY id, time ASC ";

        // Menjalankan query
        $result = mysqli_query($connect, $sql);

        // Periksa jumlah baris hasil query
        $numRows = mysqli_num_rows($result);

        if ($numRows == 0) {
           ${"data$i"}[] =["0"];
        } else {
            // Memeriksa apakah query berhasil dijalankan
            while ($row = mysqli_fetch_assoc($result)) {

                // Menyimpan data voltage sesuai dengan nomor tabel
                ${"data$i"}[] = $row['voltage'];
                ${"timeData$i"}[] = $row['time'];
            }
        }
    }

    // Menyusun data dalam format yang akan dikirim sebagai respons
    $data = array(
        'timeData1' => $timeData1,
        'timeData2' => $timeData2,
        'timeData3' => $timeData3,
        'timeData4' => $timeData4,
        'timeData5' => $timeData5,
        'timeData6' => $timeData6,
        'timeData7' => $timeData7,
        'timeData8' => $timeData6,
        'timeData9' => $timeData9,
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3,
        'data4' => $data4,
        'data5' => $data5,
        'data6' => $data6,
        'data7' => $data7,
        'data8' => $data8,
        'data9' => $data9,
    );

    // Mengembalikan data dalam format JSON
    echo json_encode($data);

    // Menutup koneksi
    mysqli_close($connect);
} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage();
}
