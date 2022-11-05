<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'monitoring';

// $host = '192.168.18.53';
// $user = 'itbdelabo';
// $pass = 'delabo0220';
// $database = 'monitoring';

$connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
    echo "connectsi ke MYSQL gagal....";
}

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

$cost_1 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
$row_1 = mysqli_fetch_array($cost_1);
$cost_bar_1 = $row_1['carbon_emission'];

$cost_2 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 20');
$row_2 = mysqli_fetch_array($cost_2);
$cost_bar_2 = $row_2['carbon_emission'];

$cost_3 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 20');
$row_3 = mysqli_fetch_array($cost_3);
$cost_bar_3 = $row_3['carbon_emission'];

$cost_4 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 20');
$row_4 = mysqli_fetch_array($cost_4);
$cost_bar_4 = $row_4['carbon_emission'];

$cost_5 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 20');
$row_5 = mysqli_fetch_array($cost_5);
$cost_bar_5 = $row_5['carbon_emission'];

$cost_6 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 20');
$row_6 = mysqli_fetch_array($cost_6);
$cost_bar_6 = $row_6['carbon_emission'];

$cost_7 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 20');
$row_7 = mysqli_fetch_array($cost_7);
$cost_bar_7 = $row_7['carbon_emission'];

$cost_8 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 20');
$row_8 = mysqli_fetch_array($cost_8);
$cost_bar_8 = $row_8['carbon_emission'];



?>

<script>
    console.log("PPP",<?php echo $cost_bar_1 ?>)
</script>

<ul>
    <li>
        <h5>Smart Plug 1</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_1 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 2</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_2 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 3</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_3 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 4</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_4 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 5</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_5 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 6</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_6 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 7</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_7 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 8</h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_8 ?>%;"></div>
        </div>
    </li>

</ul>