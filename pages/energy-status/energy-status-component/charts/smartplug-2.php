<?php
include('../../../../database/config.php');

$time  = mysqli_query($connect, 'SELECT time FROM tuya_smart_plug_2 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$voltage  = mysqli_query($connect, 'SELECT voltage FROM tuya_smart_plug_2 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 20');
$current  = mysqli_query($connect, 'SELECT current FROM tuya_smart_plug_2 WHERE current IS NOT NULL ORDER BY id DESC LIMIT 20');
$power  = mysqli_query($connect, 'SELECT power FROM tuya_smart_plug_2 WHERE power IS NOT NULL ORDER BY id DESC LIMIT 20');
$electricity  = mysqli_query($connect, 'SELECT electricity FROM tuya_smart_plug_2 WHERE electricity IS NOT NULL ORDER BY id DESC LIMIT 20');


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

<div class="panel panel-primary" style="height:50vh; width:100%">
    <canvas id="myChart2"></canvas>
    <script>
        var labels = newDataset;

        var data = {
            labels: labels,
            datasets: [{
                label: 'Electricity(kWh)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Set the color of the area under the line
                borderColor: 'RGBA( 0, 255, 255, 1 )', // Set the color of the line with 50% opacity
                pointBackgroundColor: 'red',
                pointBorderColor: 'red',
                borderWidth: 2,
                fill: true,
                data: [<?php
                        while ($b = mysqli_fetch_array($power)) {
                            echo  $b['power'] . ',';
                        }
                        ?>],
            }, {
                label: 'Power (Watt)',
                backgroundColor: 'red', // Set the color of the area under the line
                borderColor: 'red', // Set the color of the line with 50% opacity
                borderWidth: 2,
                fill: true,
            }]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        display: true,
                        // position: 'top',
                        reverse: true,
                        title: {
                            display: true,
                            text: 'Time'
                        },


                    },
                    y: {
                        beginAtZero: true,
                        display: true,
                        title: {
                            display: true,
                            text: 'Energy (kWh)'
                        },
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'kWh Real-time Energy Monitoring'
                    }
                },
                animation: false,
                interaction: {
                    intersect: false,
                },
            }
        };

        var myChart = new Chart(
            document.getElementById('myChart2'),
            config
        );
    </script>
</div>