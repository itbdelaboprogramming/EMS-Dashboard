<?php
$host = 'localhost';
$user = 'root';
$pas = '';
$database = 'arduino-python';

$konek = mysqli_connect($host, $user, $pas, $database);

if (!$konek) {
    echo "koneksi ke MYSQL gagal....";
}
?>

<?php
$x_tanggal_1  = mysqli_query($konek, 'SELECT time_created FROM ( SELECT * FROM batt1 ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$random_number_1   = mysqli_query($konek, 'SELECT random_number FROM ( SELECT * FROM batt1 ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary">
    <div class="panel-body">
        <canvas id="myChart2"></canvas>
        <script>
            const labels = [<?php while ($b = mysqli_fetch_array($x_tanggal_1)) {
                                echo '"' . $b['time_created'] . '",';
                            }
                            ?>]

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Distance',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php while ($b = mysqli_fetch_array($random_number_1)) {
                                echo  $b['random_number'] . ',';
                            } ?>],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    animation: false,
                }
            };

            const myChart = new Chart(
                document.getElementById('myChart2'),
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
                $sqlAdmin = mysqli_query($konek, "SELECT * FROM sensor_ultrasonic ORDER BY ID DESC LIMIT 0,20");
                while ($data = mysqli_fetch_array($sqlAdmin)) {

                    echo "<tr >
                <td><center>$index</center></td>
                <td><center>$data[time_created]</center></td> 
                <td><center>$data[distance]</td>
              </tr>";
                    $index++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>