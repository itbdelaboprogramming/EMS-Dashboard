<?php
include('../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

// BATT 1
$kwh_1  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
$row1 = mysqli_fetch_array($kwh_1);
$progress_bar_1 = $row1['total_electricity'] * 100;
kwhComponentValue($progress_bar_1, 1);

// BATT 2
$kwh_2  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 20');
$row2 = mysqli_fetch_array($kwh_2);
$progress_bar_2 = $row2['total_electricity'] * 100;
kwhComponentValue($progress_bar_2, 2);
// BATT 3
$kwh_3  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 20');
$row3 = mysqli_fetch_array($kwh_3);
$progress_bar_3 = $row3['total_electricity'] * 100;
kwhComponentValue($progress_bar_3, 3);
// BATT 4
$kwh_4  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 20');
$row4 = mysqli_fetch_array($kwh_4);
$progress_bar_4 = $row4['total_electricity'] * 100;
kwhComponentValue($progress_bar_4, 4);
// BATT 5
$kwh_5  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 20');
$row5 = mysqli_fetch_array($kwh_5);
$progress_bar_5 = $row5['total_electricity'] * 100;
kwhComponentValue($progress_bar_5, 5);
// BATT 6
$kwh_6  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 20');
$row6 = mysqli_fetch_array($kwh_6);
$progress_bar_6 = $row6['total_electricity'] * 100;
kwhComponentValue($progress_bar_6, 6);
// BATT 7
$kwh_7  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 20');
$row7 = mysqli_fetch_array($kwh_7);
$progress_bar_7 = $row7['total_electricity'] * 100;
kwhComponentValue($progress_bar_7, 7);
// BATT 8
$kwh_8  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 20');
$row8 = mysqli_fetch_array($kwh_8);
$progress_bar_8 = $row8['total_electricity'] * 100;
kwhComponentValue($progress_bar_8, 8);

function kwhComponentValue($value, $id)
{
?>
    <script>
        document.getElementById(`kwh-component-value-${<?php echo $id ?>}`).innerHTML = <?php echo $value ?>;
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../assets/style.css">
</head>

<body>
    <!-- <ul>
        <li>
            <h5>Smart Plug 1 <span id="kwh-component-value-1" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_1 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 2 <span id="kwh-component-value-2" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_2 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 3 <span id="kwh-component-value-3" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_3 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 4 <span id="kwh-component-value-4" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_4 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 5 <span id="kwh-component-value-5" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_5 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 6 <span id="kwh-component-value-6" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_6 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 7 <span id="kwh-component-value-7" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_7 ?>%;"></div>
            </div>
        </li>
        <li>
            <h5>Smart Plug 8 <span id="kwh-component-value-8" class="value-component"></span></h5>
        </li>
        <li>
            <div class="progress-bar-section">
                <div class="background-bar"></div>
                <div class="progress-bar" style="width:<?php echo $progress_bar_8 ?>%;"></div>
            </div>
        </li>
    </ul> -->

    <div class="panel-section">
        <div class="panel-section-title">
            <h5>
                kWh Electricity Status
            </h5>
        </div>
        <div class="panel-section-data">
            <ul>
                <li>
                    <h5>Smart Plug 1 <span id="kwh-component-value-1" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_1 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 2 <span id="kwh-component-value-2" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_2 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 3 <span id="kwh-component-value-3" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_3 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 4 <span id="kwh-component-value-4" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_4 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 5 <span id="kwh-component-value-5" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_5 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 6 <span id="kwh-component-value-6" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_6 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 7 <span id="kwh-component-value-7" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_7 ?>%;"></div>
                    </div>
                </li>
                <li>
                    <h5>Smart Plug 8 <span id="kwh-component-value-8" class="value-component"></span></h5>
                </li>
                <li>
                    <div class="progress-bar-section">
                        <div class="background-bar"></div>
                        <div class="progress-bar" style="width:<?php echo $progress_bar_8 ?>%;"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>