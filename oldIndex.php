<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="transition.css"> -->
    <link href="style.css" rel="stylesheet" >
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./components/newNavbar.css">

    <script src="https://kit.fontawesome.com/1eef294ba4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/js.js"></script>
    <title>Energy Management System</title>
</head>

<body>
    <?php
    include('./components/newNavbar');
    ?>

    <div id="myContent" class="main-content" onmouseover="closeNav()">
        <div id="dashboard" class="tabcontent">
            <select class="div-toggle" data-target=".my-info-1">
                <option value="Batt-1" data-show=".Batt-1">Battery-1</option>
                <option value="Batt-2" data-show=".Batt-2">Battery-2</option>
                <option value="Batt-3" data-show=".Batt-3">Battery-3</option>
                <option value="Batt-4" data-show=".Batt-4">Battery-4</option>
                <option value="Batt-5" data-show=".Batt-5">Battery-5</option>
                <option value="Batt-6" data-show=".Batt-6">Battery-6</option>
                <option value="Batt-7" data-show=".Batt-7">Battery-7</option>
                <option value="Batt-8" data-show=".Batt-8">Battery-8</option>
                <option value="Batt-9" data-show=".Batt-9">Battery-9</option>
                <option value="Batt-10" data-show=".Batt-10">Battery-10</option>
                <option value="Batt-11" data-show=".Batt-11">Battery-11</option>
                <option value="Batt-12" data-show=".Batt-12">Battery-12</option>
            </select>

            <script src="jquery-latest.js"></script>
            <script>

            </script>

            <div class="my-info-1">
                <div class="Batt-1" id="responsecontainer1"></div>
                <!-- <div class="Batt-2" id="responsecontainer2"></div> -->
                <script>
                    var refreshId = setInterval(function() {
                        $('#responsecontainer1').load('./data/ultrasonic.php');
                        // $('#responsecontainer2').load('./data/batt1.php');
                    }, 1000);
                </script>
            </div>

            <!-- <div class=" chart-section"> -->
            <div id="responsecontainer"></div>
            <!-- </div> -->
        </div>

        
        <?php
        // include('./pages/battery-status.php');
        // include('./pages/daily-report.php');
        // include('./pages/events.php');
        // include('./pages/monthly-report.php');
        // include('./pages/yearly-report.php');
        ?>

    </div>

    <script>
        var interval;
        var refreshId;
        var refreshId2;

        $(document).on('change', '.div-toggle', function() {
            var target = $(this).data('target');
            var show = $("option:selected", this).data('show');
            $(target).children().addClass('hide');
            $(show).removeClass('hide');
        });
        $(document).ready(function() {
            $('.div-toggle').trigger('change');
        });
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>