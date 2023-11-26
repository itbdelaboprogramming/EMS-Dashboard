<?php
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $database = 'monitoring';

// Zerotier
$host = '10.147.17.108';
$user = 'admin';
$pass = 'admin';
$database = 'monitoring';

// lab connection
// $host = '192.168.18.19';
// $user = 'admin';
// $pass = 'admin';
// $database = 'monitoring';

$connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
    echo "connection to MYSQL is failed....";
}

?>
