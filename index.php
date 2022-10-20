<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- IMPORT CSS SECTION -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="assets/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./assets/newNavbar.css">
    <link rel="stylesheet" href="./assets/newStyle.css">

    <!-- IMPORT SCRIPT SECTION -->
    <script src="https://kit.fontawesome.com/1eef294ba4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/js.js"></script>
    <title>Energy Management System</title>
</head>

<body>
    <?php
    include('./components/newNavbar.php');
    ?>
    <div class="date-section">
        <h5 id="dateSection"></h5>
    </div>

    <section class="home-section">
        <?php
        include('./pages/battery-status.php');
        // include('./pages/daily-report.php');
        // include('./pages/events.php');
        // include('./pages/monthly-report.php');
        // include('./pages/yearly-report.php');
        ?>
    </section>

    <!-- SCRIPT SECTION -->
    <script>
        var today = new Date();
        today = parseInt(today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear() + " " + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        document.getElementById("dateSection").innerHTML = today
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>