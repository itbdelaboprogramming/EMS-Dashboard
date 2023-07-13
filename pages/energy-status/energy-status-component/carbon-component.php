<?php
include('../../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

$carbon_1 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
$row_1 = mysqli_fetch_array($carbon_1);
$carbon_bar_1 = $row_1['carbon_emission'];
carbonComponentValue($carbon_bar_1, 1);

$carbon_2 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 20');
$row_2 = mysqli_fetch_array($carbon_2);
$carbon_bar_2 = $row_2['carbon_emission'];
carbonComponentValue($carbon_bar_2, 2);

$carbon_3 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 20');
$row_3 = mysqli_fetch_array($carbon_3);
$carbon_bar_3 = $row_3['carbon_emission'];
carbonComponentValue($carbon_bar_3, 3);

$carbon_4 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 20');
$row_4 = mysqli_fetch_array($carbon_4);
$carbon_bar_4 = $row_4['carbon_emission'];
carbonComponentValue($carbon_bar_4, 4);

$carbon_5 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 20');
$row_5 = mysqli_fetch_array($carbon_5);
$carbon_bar_5 = $row_5['carbon_emission'];
carbonComponentValue($carbon_bar_5, 5);

$carbon_6 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 20');
$row_6 = mysqli_fetch_array($carbon_6);
$carbon_bar_6 = $row_6['carbon_emission'];
carbonComponentValue($carbon_bar_6, 6);

$carbon_7 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 20');
$row_7 = mysqli_fetch_array($carbon_7);
$carbon_bar_7 = $row_7['carbon_emission'];
carbonComponentValue($carbon_bar_7, 7);

$carbon_8 = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 20');
$row_8 = mysqli_fetch_array($carbon_8);
$carbon_bar_8 = $row_8['carbon_emission'];
carbonComponentValue($carbon_bar_8, 8);

function carbonComponentValue($value, $id)
{
?>
    <script>
        document.getElementById(`carbon-component-value-${<?php echo $id ?>}`).innerHTML = <?php echo $value ?>;
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">


<body>
    <div class="panel-section">
        <div class="panel-section-title">
            <h5>Carbon Footprint</h5>
        </div>
        <div class="panel-section-data">
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
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_1 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-1" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_2 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-2" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_3 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-3" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_4 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-4" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Refrigerator</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_5 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-5" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Dispenser</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_6 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-6" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">TV</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_7 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-7" class="value-component">
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">3D Print</td>
                        <td colspan="2">
                            <div class="progress-bar-section">
                                <div class="progress2 progress-moved">
                                    <div class="progress-bar2" style="width:<?php echo $carbon_bar_8 ?>%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="carbon-component-value-8" class="value-component">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>