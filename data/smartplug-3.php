<?php
include('../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_3 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_3 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
?>
<script>
    var dataset = [];
    var newDataset = [];
</script>
<?php
while ($b = mysqli_fetch_array($time)) {
?>
    <script>
        dataset.push(<?php echo '"' . $b['time'] . '",'; ?>)
    </script>
<?php
}
?>
<script>
    dataset.forEach((score) => {
        let newTimeFormat = score.split(":");
        newDataset.push(`${newTimeFormat[0]}:${newTimeFormat[1]}`)
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="panel panel-primary" style="height:50vh; width:90vw">
    <canvas id="myChart3"></canvas>
    <script>
        const labels = newDataset

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
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Realtime Energy Monitoring'
                    }
                },
                animation: false,
                interaction: {
                    intersect: false,
                },
            }
        };


        const myChart = new Chart(
            document.getElementById('myChart3'),
            config
        );
    </script>
</div>