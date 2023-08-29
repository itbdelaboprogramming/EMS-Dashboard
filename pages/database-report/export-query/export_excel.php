<?php
include("../../../database/config.php");
$tablesSelected = $_GET['selectedOption'];
?>


<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_$tablesSelected.xls");
    ?>

    <center>
        <h1>Export Data Ke Excel Dengan PHP <br /> www.malasngoding.com</h1>
    </center>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Time</th>
            <th>Voltage</th>
            <th>Current</th>
            <th>Power</th>
            <th>Electricity</th>
            <th>Day</th>
            <th>Week</th>
            <th>Month</th>
            <th>Total Electricity</th>
            <th>Total Cost</th>
            <th>Carbon Emission</th>
        </tr>
        <?php
        $data = mysqli_query($connect, "select * from tuya_smart_plug_$tablesSelected");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['time']; ?></td>
                <td><?php echo $d['voltage']; ?></td>
                <td><?php echo $d['current']; ?></td>
                <td><?php echo $d['power']; ?></td>
                <td><?php echo $d['electricity']; ?></td>
                <td><?php echo $d['day']; ?></td>
                <td><?php echo $d['week']; ?></td>
                <td><?php echo $d['month']; ?></td>
                <td><?php echo $d['total_electricity']; ?></td>
                <td><?php echo $d['total_cost']; ?></td>
                <td><?php echo $d['carbon_emission']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>