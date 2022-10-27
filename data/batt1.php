<?php
$host = '192.168.18.53';
$user = 'itbdelabo';
$pass = 'delabo0220';
$database = 'monitoring';

$connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
    echo "connectsi ke MYSQL gagal....";
}
?>

<?php
$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
// $current  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $power  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $electricity  = mysqli_query($connect, 'SELECT electricity FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $day  = mysqli_query($connect, 'SELECT day FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $week  = mysqli_query($connect, 'SELECT week FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $month  = mysqli_query($connect, 'SELECT month FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $total_electricity  = mysqli_query($connect, 'SELECT total_electricity FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $total_cost  = mysqli_query($connect, 'SELECT total_cost FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');
// $carbon_emission  = mysqli_query($connect, 'SELECT carbon_emission FROM tuya_smart_plug_1 ORDER BY id DESC LIMIT 20');

$y_temperature   = mysqli_query($connect, 'SELECT temperature FROM cpu_temperature WHERE temperature IS NOT NULL ORDER BY id DESC LIMIT 20');
?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary">
    <div class="panel-body">
        <canvas id="myChart"></canvas>
        <script>
            const labels = [<?php
                            while ($b = mysqli_fetch_array($time)) {
                                echo '"' . $b['time'] . '",';
                            }
                            ?>]

            const data = {
                labels: labels,
                datasets: [{
                    label: 'voltage',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php
                            while ($b = mysqli_fetch_array($voltage)) {
                                echo  $b['voltage'] . ',';
                            }
                            ?>],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    animation: false,
                    interaction: {
                        intersect: false,
                    },
                }
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
    </div>
</div>

<!-- <div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <center>Log Temperature
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class='text-center'>Number</th>
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Temperature</th>
                </tr>
            </thead>

            <tbody>
                <?php
            //     $index = 1;
            //     $sqlAdmin = mysqli_query($connect, "SELECT * FROM cpu_temperature ORDER BY ID DESC LIMIT 0,20");
            //     while ($data = mysqli_fetch_array($sqlAdmin)) {

            //         echo "<tr >
            //     <td><center>$index</center></td>
            //     <td><center>$data[time]</center></td> 
            //     <td><center>$data[temperature]</td>
            //   </tr>";
            //         $index++;
            //     }
                ?>
            </tbody>
        </table>
    </div>
</div> -->