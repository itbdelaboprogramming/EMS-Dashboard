<?php
include('../../../database/config.php');

$status_1 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 2');
$status_2 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_2 ORDER BY id DESC LIMIT 2');
$status_3 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_3 ORDER BY id DESC LIMIT 2');
$status_4 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_4 ORDER BY id DESC LIMIT 2');
$status_5 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_5 ORDER BY id DESC LIMIT 2');
$status_6 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_6 ORDER BY id DESC LIMIT 2');
$status_7 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_7 ORDER BY id DESC LIMIT 2');
$status_8 = mysqli_query($connect, 'SELECT id,current,voltage FROM tuya_smart_plug_8 ORDER BY id DESC LIMIT 2');

function statusChanger($id, $voltage, $current, $statusId)
{
    if ($id % 2 != 0) {
        if ($voltage > 0) {
            if ($current > 0) {
?>
                <script>
                    var theNumber = "status-" + <?php echo "$statusId"; ?>;
                    document.getElementById(theNumber).innerHTML = "Online"
                    document.getElementById(theNumber).style.color = "green"
                </script>
            <?php
            } else {
            ?>
                <script>
                    theNumber = "status-" + <?php echo "$statusId"; ?>;
                    document.getElementById(theNumber).innerHTML = "Idle"
                    document.getElementById(theNumber).style.color = "rgb(225, 214, 0)"
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                theNumber = "status-" + <?php echo "$statusId"; ?>;
                document.getElementById(theNumber).innerHTML = "Offline"
                document.getElementById(theNumber).style.color = "blue"
            </script>
    <?php
        }
    }
}

while ($row_1 = mysqli_fetch_array($status_1)) {
    $id_1 = $row_1['id'];
    $current_1 = $row_1['current'];
    $voltage_1 = $row_1['voltage'];
    $smartplug_number = 1;
    statusChanger($id_1, $voltage_1, $current_1, $smartplug_number);

    $row_2 = mysqli_fetch_array($status_2);
    $id_2 = $row_2['id'];
    $current_2 = $row_2['current'];
    $voltage_2 = $row_2['voltage'];
    $smartplug_number = 2;
    statusChanger($id_2, $voltage_2, $current_2, $smartplug_number);

    $row_3 = mysqli_fetch_array($status_3);
    $id_3 = $row_3['id'];
    $current_3 = $row_3['current'];
    $voltage_3 = $row_3['voltage'];
    $smartplug_number = 3;
    statusChanger($id_3, $voltage_3, $current_3, $smartplug_number);

    $row_4 = mysqli_fetch_array($status_4);
    $id_4 = $row_4['id'];
    $current_4 = $row_4['current'];
    $voltage_4 = $row_4['voltage'];
    $smartplug_number = 4;
    statusChanger($id_4, $voltage_4, $current_4, $smartplug_number);

    $row_5 = mysqli_fetch_array($status_5);
    $id_5 = $row_5['id'];
    $current_5 = $row_5['current'];
    $voltage_5 = $row_5['voltage'];
    $smartplug_number = 5;
    statusChanger($id_5, $voltage_5, $current_5, $smartplug_number);

    $row_6 = mysqli_fetch_array($status_6);
    $id_6 = $row_6['id'];
    $current_6 = $row_6['current'];
    $voltage_6 = $row_6['voltage'];
    $smartplug_number = 6;
    statusChanger($id_6, $voltage_6, $current_6, $smartplug_number);

    $row_7 = mysqli_fetch_array($status_7);
    $id_7 = $row_7['id'];
    $current_7 = $row_7['current'];
    $voltage_7 = $row_7['voltage'];
    $smartplug_number = 7;
    statusChanger($id_7, $voltage_7, $current_7, $smartplug_number);

    $row_8 = mysqli_fetch_array($status_8);
    $id_8 = $row_8['id'];
    $current_8 = $row_8['current'];
    $voltage_8 = $row_8['voltage'];
    $smartplug_number = 8;
    statusChanger($id_8, $voltage_8, $current_8, $smartplug_number);

    ?>

<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="panel-section">
        <div class="panel-section-title">
            <h5>
                Data Communication Status
            </h5>
        </div>
        <div class="panel-section-data">
            <div>
                <table class="table">
                    <thead class="sticky-top" style="background-color: red;width:fit-content">
                        <tr>
                            <th colspan="2">Utility</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-1"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-2"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-3"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-4"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">Refrigerator</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-5"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">Dispenser</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-6"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">TV</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-7"></span>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">3D Print</td>
                            <td colspan="2">
                                <span class="status_connection" id="status-8"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </ul>
        </div>
    </div>
</body>

</html>