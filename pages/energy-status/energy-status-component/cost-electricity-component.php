<?php
include('../../../database/config.php');

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

<div class="panel-section">
    <div class="panel-section-title">
        <h5>Cost Electricity</h5>
    </div>
    <div class="panel-section-data">
        <div class="header-table-kwh-component">
            <table class="table">
                <thead class="sticky-top" style="background-color: red;width:fit-content">
                    <tr>
                        <th scope="col">Utility</th>
                        <th colspan="2">Progress</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_1 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-1" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_2 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-2" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_3 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-3" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_4 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-4" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Refrigerator</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_5 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-5" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Dispenser</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_6 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-6" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">TV</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_7 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-7" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">3D Print</td>
                        <td colspan="2">
                            <div class="progress2 progress-moved">
                                <div class="progress-bar2" style="width:<?php echo $cost_bar_8 ?>%;">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="cost-component-value-8" class="value-component">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>