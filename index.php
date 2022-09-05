<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="transition.css"> -->
    <link rel="stylesheet" href="style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">


    <script src="https://kit.fontawesome.com/1eef294ba4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/js.js"></script>
    <!-- <script type="text/javascript" src="./utils/data.js"></script>
    <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script> -->

    <title>Document</title>
</head>

<body>
    <?php
    include('./components/navbar.php');
    ?>

    <div id="myContent" class="main-content" onmouseover="closeNav()">
        <div id="dashboard" class="tabcontent">
            <select class="div-toggle" data-target=".my-info-1">
                <option value="Batt-1" data-show=".Batt-1">Batt-1</option>
                <option value="Batt-2" data-show=".Batt-2">Batt-2</option>
                <option value="Batt-3" data-show=".Batt-3">Batt-3</option>
                <option value="Batt-4" data-show=".Batt-4">Batt-4</option>
                <option value="Batt-5" data-show=".Batt-5">Batt-5</option>
                <option value="Batt-6" data-show=".Batt-6">Batt-6</option>
                <option value="Batt-7" data-show=".Batt-7">Batt-7</option>
                <option value="Batt-8" data-show=".Batt-8">Batt-8</option>
                <option value="Batt-9" data-show=".Batt-9">Batt-9</option>
                <option value="Batt-10" data-show=".Batt-10">Batt-10</option>
                <option value="Batt-11" data-show=".Batt-11">Batt-11</option>
                <option value="Batt-12" data-show=".Batt-12">Batt-12</option>
            </select>

            <script src="jquery-latest.js"></script>
            <script>

            </script>

            <div class="my-info-1">
                <div class="Batt-1" id="responsecontainer1"></div>
                <div class="Batt-2" id="responsecontainer2"></div>
                <script>
                    var refreshId = setInterval(function() {
                        $('#responsecontainer1').load('./data/ultrasonic.php');
                        $('#responsecontainer2').load('./data/batt1.php');
                    }, 1000);
                </script>
            </div>

            <!-- <div class=" chart-section"> -->
            <div id="responsecontainer"></div>
            <!-- </div> -->
        </div>

        <?php
        include('./pages/battery-status.php');
        include('./pages/daily-report.php');
        include('./pages/events.php');
        include('./pages/monthly-report.php');
        include('./pages/yearly-report.php');
        ?>

    </div>

    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.width = "220px"
            document.getElementById("myContent").style.marginLeft = "220px";
        }
        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "60px"
            document.getElementById("myContent").style.marginLeft = "70px";
        }

        $(".animated-progress span").each(function() {
            $(this).animate({
                    width: $(this).attr("data-progress") + "%",
                },
                1000
            );
            $(this).text($(this).attr("data-progress") + "%");
        });

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