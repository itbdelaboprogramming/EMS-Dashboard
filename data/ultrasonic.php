<?php
$host = '192.168.18.53';
$user = 'itbdelabo';
$pass = 'delabo0220';
$database = 'monitoring';

$connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
    echo "conection to MySQL is fail....";
}
?>

<?php
$x_date  = mysqli_query($connect, 'SELECT time FROM ( SELECT * FROM cpu_temperature ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$y_temperature   = mysqli_query($connect, 'SELECT temperature FROM ( SELECT * FROM cpu_temperature ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary">
    <div class="panel-body">
        <canvas id="myChart"></canvas>
        <script>
            const labels = [<?php while ($b = mysqli_fetch_array($x_date)) {
                                echo '"' . $b['time'] . '",';
                            }
                            ?>]

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Temperature',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php while ($b = mysqli_fetch_array($y_temperature)) {
                                echo  $b['temperature'] . ',';
                            } ?>],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
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

<div class="panel panel-primary">
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
                $index = 1;
                $sqlAdmin = mysqli_query($connect, "SELECT * FROM cpu_temperature ORDER BY ID DESC LIMIT 0,20");
                while ($data = mysqli_fetch_array($sqlAdmin)) {

                    echo "<tr >
                            <td><center>$index</center></td>
                            <td><center>$data[time]</center></td> 
                            <td><center>$data[temperature]</td>
                         </tr>";
                    $index++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
