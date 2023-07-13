<?php
include('../../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 1
$voltage_1  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_1  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_1 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_1  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_1 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 2
$voltage_2  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_2 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_2  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_2 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_2  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_2 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 3
$voltage_3  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_3 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_3  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_3 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_3  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_3 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 4
$voltage_4  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_4 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_4  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_4 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_4  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_4 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 5
$voltage_5  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_5 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_5  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_5 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_5  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_5 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 6
$voltage_6  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_6 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_6  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_6 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_6  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_6 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 7
$voltage_7  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_7 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_7  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_7 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_7  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_7 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 8
$voltage_8  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_8 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_8  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_8 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_8  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_8 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

// Smartplug 9
$voltage_9  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_9 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current_9  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_9 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power_9  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_9 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');

?>
<div class="panel-section">
    <div class="panel-section-title">
        <h5>Electricity Status</h5>
    </div>
    <div class="panel-section-data">
        <ul>
            <li>
                <h5>Smart Plug 1</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row1 = mysqli_fetch_array($voltage_1);
                            echo $row1['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row1 = mysqli_fetch_array($current_1);
                            echo $row1['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row1 = mysqli_fetch_array($power_1);
                            echo $row1['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 2</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row2 = mysqli_fetch_array($voltage_2);
                            echo $row2['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row2 = mysqli_fetch_array($current_2);
                            echo $row2['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row2 = mysqli_fetch_array($power_2);
                            echo $row2['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 3</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row3 = mysqli_fetch_array($voltage_3);
                            echo $row3['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row3 = mysqli_fetch_array($current_3);
                            echo $row3['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row3 = mysqli_fetch_array($power_3);
                            echo $row3['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 4</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row4 = mysqli_fetch_array($voltage_4);
                            echo $row4['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row4 = mysqli_fetch_array($current_4);
                            echo $row4['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row4 = mysqli_fetch_array($power_4);
                            echo $row4['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 5</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row5 = mysqli_fetch_array($voltage_5);
                            echo $row5['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row5 = mysqli_fetch_array($current_5);
                            echo $row5['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row5 = mysqli_fetch_array($power_5);
                            echo $row5['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 6</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row6 = mysqli_fetch_array($voltage_6);
                            echo $row6['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row6 = mysqli_fetch_array($current_6);
                            echo $row6['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row6 = mysqli_fetch_array($power_6);
                            echo $row6['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 7</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row7 = mysqli_fetch_array($voltage_7);
                            echo $row7['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row7 = mysqli_fetch_array($current_7);
                            echo $row7['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row7 = mysqli_fetch_array($power_7);
                            echo $row7['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
            <li>
                <h5>Smart Plug 8</h5>
            </li>
            <li>
                <div class="electricity-status">
                    <div class="voltage">
                        <span>V : </span>
                        <span>
                            <?php
                            $row8 = mysqli_fetch_array($voltage_8);
                            echo $row8['voltage'];
                            ?>
                        </span>
                        <span>Volt</span>
                    </div>
                    <div class="current">
                        <span>I : </span>
                        <span>
                            <?php
                            $row8 = mysqli_fetch_array($current_8);
                            echo $row8['current'];
                            ?></span>
                        <span>A</span>
                    </div>
                    <div class="power">
                        <span>P : </span>
                        <span>
                            <?php
                            $row8 = mysqli_fetch_array($power_8);
                            echo $row8['power'];
                            ?></span>
                        <span>Watt</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>