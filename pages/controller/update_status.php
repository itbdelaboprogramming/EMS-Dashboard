<?php
include('../../database/config.php');

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect MySQL: " . mysqli_connect_error();
    exit();
}

// Periksa apakah ada data yang dikirim melalui AJAX
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Perbarui status berdasarkan ID
    $query = "UPDATE controller SET status = '$status', timeUpdated = DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') WHERE id = '$id'";
    mysqli_query($connect, $query);

    // Tambahkan pemeriksaan kegagalan query jika diperlukan

    // Kirim respons ke JavaScript
    echo "Status updated success.";
}

// Tutup koneksi ke database
mysqli_close($connect);
?>
