<?php
include('../../database/config.php');

$query;
$timeInterval;

// if ($interval == 'custom') {
$startDate;
$endDate;
$utility = $_POST['utility'];
$interval = $_POST['interval-chart'];

echo "DDDD";

if ($interval === "custom-chart") {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $timeInterval = "time BETWEEN '$startDate' AND '$endDate'";
} else {
    // Tambahkan kode untuk mengambil data dengan interval daily, weekly, dan monthly dari database
    if ($interval === "daily") {
        $timeInterval = "DATE(time) = CURDATE()";
    } elseif ($interval === "weekly") {
        $timeInterval = "YEARWEEK(time) = YEARWEEK(CURDATE())";
    } elseif ($interval === "monthly") {
        $timeInterval = "MONTH(time) = MONTH(CURDATE())";
    }
}

echo $utility;

if ($utility !== "all") {
    echo "EEEE";
    // $query = "SELECT current,electricity,carbon_emission FROM $utility WHERE $timeInterval";
    $time  = mysqli_query($connect, "SELECT time FROM $utility WHERE voltage IS NOT NULL AND $timeInterval ORDER BY id");
    $voltage  = mysqli_query($connect, "SELECT voltage FROM $utility WHERE voltage IS NOT NULL AND $timeInterval ORDER BY id");
    $current  = mysqli_query($connect, "SELECT current FROM $utility WHERE current IS NOT NULL AND $timeInterval ORDER BY id");
    $power  = mysqli_query($connect, "SELECT power FROM $utility WHERE power IS NOT NULL AND $timeInterval ORDER BY id");
    $electricity  = mysqli_query($connect, "SELECT electricity FROM $utility WHERE electricity IS NOT NULL AND $timeInterval ORDER BY id");
} else {
    echo "WWWWW";
}
echo "GGGGGG";
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
echo "JJJJJJ";
}
?>
<script>
    console.log("KKKK");
    dataset.forEach((score) => {
        let newTimeFormat = score.split(":");
        newDataset.push(`${newTimeFormat[0]}:${newTimeFormat[1]}`)
    })
</script>

<div class="panel panel-primary" style="height:50vh; width:100%">
    <canvas id="myChart"></canvas>
    <script>
        console.log("llll");
        var labels = newDataset;

        console.log("labels ", labels);

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

        console.log("data ", data);
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
            document.getElementById('myChart'),
            config
        );
    </script>
</div>