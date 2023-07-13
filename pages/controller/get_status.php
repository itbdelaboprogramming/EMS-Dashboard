<?php
// Koneksi ke database
include('../../database/config.php');

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

// Mengambil data status dari tabel 'controller'
$query = "SELECT status FROM controller";
$result = mysqli_query($connect, $query);

$statusData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $statusData[] = $row;
}

// Mengirim data status dalam format JSON ke JavaScript
header('Content-Type: application/json');
echo json_encode($statusData);

// Tutup koneksi ke database
mysqli_close($connect);
?>
