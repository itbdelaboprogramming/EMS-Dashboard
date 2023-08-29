<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'monitoring';

// $host = '10.243.158.97';
// $user = 'admin';
// $pass = 'admin';
// $database = 'monitoring';

$connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
    echo "connection to MYSQL is failed....";
}

?>
