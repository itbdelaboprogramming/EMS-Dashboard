

<?php
include('../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_8 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_8 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary">
    <div class="panel-body">
        <canvas id="myChart8"></canvas>
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
                document.getElementById('myChart8'),
                config
            );
        </script>
    </div>
</div>