<?php
include('../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_7 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_7 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary" style="height:50vh; width:90vw">
    <canvas id="myChart7"></canvas>
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
                responsive: true,
                maintainAspectRatio: false,
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
            document.getElementById('myChart7'),
            config
        );
    </script>
</div>