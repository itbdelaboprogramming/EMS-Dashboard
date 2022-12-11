<?php
include('../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_6 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_6 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_6 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_6 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');
$electricity  = mysqli_query($connect, 'SELECT electricity FROM tuya_smart_plug_6 WHERE electricity IS NOT NULL ORDER BY id DESC LIMIT 20');

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
    <canvas id="myChart6"></canvas>
    <script>
        const labels = newDataset

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Current (A)',
                    backgroundColor: '#EA047E',
                    borderColor: '#EA047E',
                    data: [<?php
                            while ($b = mysqli_fetch_array($current)) {
                                echo  $b['current'] . ',';
                            }
                            ?>],
                },
                {
                    label: 'Voltage (V)',
                    backgroundColor: '#FF6D28',
                    borderColor: '#FF6D28',
                    data: [<?php
                            while ($b = mysqli_fetch_array($voltage)) {
                                echo  $b['voltage'] . ',';
                            }
                            ?>],
                },
                {
                    label: 'Power (Watt)',
                    backgroundColor: '#FCE700',
                    borderColor: '#FCE700',
                    data: [<?php
                            while ($b = mysqli_fetch_array($power)) {
                                echo  $b['power'] . ',';
                            }
                            ?>],
                },
                {
                    label: 'Electricity (Watt)',
                    backgroundColor: '#00F5FF',
                    borderColor: '#00F5FF',
                    data: [<?php
                            while ($b = mysqli_fetch_array($electricity)) {
                                echo  $b['electricity'] . ',';
                            }
                            ?>],
                },
            ]
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
            document.getElementById('myChart6'),
            config
        );
    </script>
</div>