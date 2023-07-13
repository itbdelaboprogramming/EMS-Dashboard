<head>
    <link rel="stylesheet" href="./pages/energy-status/energy-status.css">
</head>
<div id="smartplug-status" class="tabcontent energy_status-pages" style="display:block;">
    <div class="lds-dual-ring" id="loadingContainer"></div>
    <div class="panel">
        <!-- <div class="panel-container-item" id="electricity"></div> -->
        <div class="kwh panel-container-item" id="kwh"></div>
        <div class="cost panel-container-item" id="cost"></div>
        <div class="carbon panel-container-item" id="carbon"></div>
        <div class="status panel-container-item" id="status"></div>
    </div>
    <!-- <div class="title-chart-section"> -->
    <div class="smartplug-options">
        <select class="smartplug-toggle" data-target=".chart-section">
            <option value="1" selected data-show=".Smartplug-1">Delabo Computer-1</option>
            <option value="2" data-show=".Smartplug-2">Delabo Computer-2</option>
            <option value="3" data-show=".Smartplug-3">Delabo Computer-3</option>
            <option value="4" data-show=".Smartplug-4">Delabo Computer-4</option>
            <option value="5" data-show=".Smartplug-5">Refrigerator</option>
            <option value="6" data-show=".Smartplug-6">Dispenser</option>
            <option value="7" data-show=".Smartplug-7">TV</option>
            <option value="8" data-show=".Smartplug-8">3D Print</option>
        </select>
        <!-- <button id="stopButton" class="smartplug-toggle"> Realtime Stop</button> -->
        <button onclick="startInterval()" id="startInterval"> Start </button>
        <button onclick="stopInterval()" id="stopInterval"> Stop </button>

    </div>
    <!-- </div> -->
    <div class="chart-section">
        <div class="Smartplug-1 chartContainer" id="responsecontainer1"></div>
        <div class="Smartplug-2 chartContainer hide" id="responsecontainer2"></div>
        <div class="Smartplug-3 chartContainer hide" id="responsecontainer3"></div>
        <div class="Smartplug-4 chartContainer hide" id="responsecontainer4"></div>
        <div class="Smartplug-5 chartContainer hide" id="responsecontainer5"></div>
        <div class="Smartplug-6 chartContainer hide" id="responsecontainer6"></div>
        <div class="Smartplug-7 chartContainer hide" id="responsecontainer7"></div>
        <div class="Smartplug-8 chartContainer hide" id="responsecontainer8"></div>

        <script>
            var refreshId;
            var firstLoad = true; // Tambahkan variabel untuk melacak apakah ini adalah load pertama kali
            var status = true;
            var intervalId;

            $(document).ready(function() {
                $('.smartplug-toggle').on('change', function() {
                    var demovalue = $(this).val();
                    $("div.chartContainer").hide();
                    $("#responsecontainer" + demovalue).show();
                });
            });

            // Tampilkan tampilan loading saat load pertama kali
            showLoading();

            function startInterval() {
                document.getElementById("startInterval").classList.add("activeButton");
                document.getElementById("stopInterval").classList.remove("activeButton");
                if (status) {
                    console.log(status);
                    status = true;
                    refreshId = setInterval(function() {
                        $('#responsecontainer1').load('./pages/energy-status/energy-status-component/charts/smartplug-1.php');
                        $('#responsecontainer2').load('./pages/energy-status/energy-status-component/charts/smartplug-2.php');
                        $('#responsecontainer3').load('./pages/energy-status/energy-status-component/charts/smartplug-3.php');
                        $('#responsecontainer4').load('./pages/energy-status/energy-status-component/charts/smartplug-4.php');
                        $('#responsecontainer5').load('./pages/energy-status/energy-status-component/charts/smartplug-5.php');
                        $('#responsecontainer6').load('./pages/energy-status/energy-status-component/charts/smartplug-6.php');
                        $('#responsecontainer7').load('./pages/energy-status/energy-status-component/charts/smartplug-7.php');
                        $('#responsecontainer8').load('./pages/energy-status/energy-status-component/charts/smartplug-8.php');

                        // $('#electricity').load('./pages/energy-status/energy-status-component/electricity-component.php');
                        $('#kwh').load('./pages/energy-status/energy-status-component/kwh-component.php');
                        $('#cost').load('./pages/energy-status/energy-status-component/cost-electricity-component.php');
                        $('#carbon').load('./pages/energy-status/energy-status-component/carbon-component.php');
                        $('#status').load('./pages/energy-status/energy-status-component/status-component.php');

                        if (firstLoad) {
                            hideLoading();
                            firstLoad = false;
                        }
                    }, 1000);
                }
            }

            function stopInterval() {
                document.getElementById("stopInterval").classList.add("activeButton");
                document.getElementById("startInterval").classList.remove("activeButton");
                if (status) {
                    status = false;
                    clearInterval(refreshId);
                }
            }

            window.onload = startInterval;

            function showLoading() {
                // Tampilkan tampilan loading
                $('#loadingContainer').show();
            }

            function hideLoading() {
                // Sembunyikan tampilan loading
                $('#loadingContainer').hide();
            }
        </script>
    </div>
</div>