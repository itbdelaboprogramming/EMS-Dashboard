<?php
include('../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

$cost_1 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
$row_1 = mysqli_fetch_array($cost_1);
$cost_bar_1 = $row_1['total_cost'] / 5000;
costComponentValue($cost_bar_1, 1);

$cost_2 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 20');
$row_2 = mysqli_fetch_array($cost_2);
$cost_bar_2 = $row_2['total_cost'] / 5000;
costComponentValue($cost_bar_2, 2);

$cost_3 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 20');
$row_3 = mysqli_fetch_array($cost_3);
$cost_bar_3 = $row_3['total_cost'] / 5000;
costComponentValue($cost_bar_3, 3);

$cost_4 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 20');
$row_4 = mysqli_fetch_array($cost_4);
$cost_bar_4 = $row_4['total_cost'] / 5000;
costComponentValue($cost_bar_4, 4);

$cost_5 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 20');
$row_5 = mysqli_fetch_array($cost_5);
$cost_bar_5 = $row_5['total_cost'] / 5000;
costComponentValue($cost_bar_5, 5);

$cost_6 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 20');
$row_6 = mysqli_fetch_array($cost_6);
$cost_bar_6 = $row_6['total_cost'] / 5000;
costComponentValue($cost_bar_6, 6);

$cost_7 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 20');
$row_7 = mysqli_fetch_array($cost_7);
$cost_bar_7 = $row_7['total_cost'] / 5000;
costComponentValue($cost_bar_7, 7);

$cost_8 = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 20');
$row_8 = mysqli_fetch_array($cost_8);
$cost_bar_8 = $row_8['total_cost'] / 5000;
costComponentValue($cost_bar_8, 8);


function costComponentValue($value, $id)
{
?>
    <script>
        document.getElementById(`cost-component-value-${<?php echo $id ?>}`).innerHTML = <?php echo $value ?>;
    </script>
<?php
}
?>


<!-- <ul>
    <li>
        <h5>Smart Plug 1 <span id="cost-component-value-1" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_1 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 2 <span id="cost-component-value-2" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_2 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 3 <span id="cost-component-value-3" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_3 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 4 <span id="cost-component-value-4" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_4 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 5 <span id="cost-component-value-5" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_5 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 6 <span id="cost-component-value-6" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_6 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 7 <span id="cost-component-value-7" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_7 ?>%;"></div>
        </div>
    </li>
    <li>
        <h5>Smart Plug 8 <span id="cost-component-value-8" class="value-component"></h5>
    </li>
    <li>
        <div class="progress-bar-section">
            <div class="background-bar"></div>
            <div class="progress-bar" style="width:<?php echo $cost_bar_8 ?>%;"></div>
        </div>
    </li>

</ul> -->

<div class="panel-section">
    <div class="panel-section-title">
        <h5>Cost Electricity</h5>
    </div>
    <div class="panel-section-data">
        <ul>
            <li>
                <h5>Smart Plug 1 <span id="cost-component-value-1" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_1 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 2 <span id="cost-component-value-2" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_2 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 3 <span id="cost-component-value-3" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_3 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 4 <span id="cost-component-value-4" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_4 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 5 <span id="cost-component-value-5" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_5 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 6 <span id="cost-component-value-6" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_6 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 7 <span id="cost-component-value-7" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_7 ?>%;"></div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 8 <span id="cost-component-value-8" class="value-component"></h5>
            </li>
            <li>
                <div class="progress-bar-section">
                    <div class="background-bar"></div>
                    <div class="progress-bar" style="width:<?php echo $cost_bar_8 ?>%;"></div>
                </div>
            </li>

        </ul>
    </div>
</div>