<!-- 
Company         : ITB de Labo
Software        : Energy Monitoring System
Developer       : Fajar Muhammad Noor Rozaqi and Raihan Rafif
Last Updated    : 2023-03-03 
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./assets/icons/electricity_logo.png">

    <!-- IMPORT CSS SECTION -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./components/navbar/navbar.css">
    <link rel="stylesheet" href="./assets/index.css">

    <!-- IMPORT FONTAWESOME SECTION -->
    <link rel="stylesheet" href="./assets/fontawesome/css/solid.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.css">

    <!-- IMPORT SCRIPT SECTION -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/js.js"></script>
    <script src="http://code.jquery.com/jquery-3.6.1.js"></script>
    <link href="./assets/pagination/pagination.css" rel="stylesheet" type="text/css">



    <title>Energy Monitoring System</title>
</head>

<body>
    <?php
    include('./components/navbar/navbar.php');
    ?>

    <h5 id="dateSection" class="dateSection"></h5>

    <span class="copyright-section">&copy 2023 ITBdeLabo</span>

    <section class="home-section">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        switch ($page) {
            case 'smartplug-status':
                include './pages/energy-status/energy-status.php';
                break;
            case 'database-report':
                include './pages/database-report/database-report.php';
                break;
            case 'summary':
                include './pages/summary/summary.php';
                break;
            case 'controller':
                include './pages/controller/controller.php';
                break;
            default:
                include './pages/energy-status/energy-status.php';
        }
        ?>
    </section>

    <script>
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();

            var day = String(currentTime.getDate()).padStart(2, '0');
            var month = String(currentTime.getMonth() + 1).padStart(2, '0');
            var year = String(currentTime.getFullYear()).slice(-2);

            var timeString = day + '/' + month + '/' + year + ' ' + hours + ":" + minutes + ":" + seconds;

            document.getElementById("dateSection").innerHTML = timeString;
        }

        setInterval(updateTime, 1000); // Update time every 1 second
    </script>


    <script src="assets/js/jquery.min.js"></script>
    <link href='components/pagination/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

    <!-- jQuery Library -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- Datatable JS -->
    <script src="components/pagination/DataTables/datatables.min.js"></script>

    <script src="./assets/index.js"></script>
</body>

</html>