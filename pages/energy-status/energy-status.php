<head>
    <link rel="stylesheet" href="./pages/energy-status/energy-status.css">
</head>
<div class="lds-dual-ring" id="loadingContainer"></div>
<div id="smartplug-status" class="tabcontent energy_status-pages" style="display:none;">
    <div class="panel">
        <!-- <div class="panel-container-item" id="electricity"></div> -->
        <div class="kwh panel-container-item" id="kwh">
            <div class="panel-section">
                <div class="panel-section-title">
                    <h5>
                        kWh Electricity Status
                    </h5>
                </div>
                <div class="panel-section-data">
                    <div class="header-table-kwh-component">
                        <table class="table">
                            <thead class="sticky-top" style="background-color: red;width:fit-content">
                                <tr>
                                    <th scope="col">Utility</th>
                                    <th colspan="2">Progress</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-1" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-1"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-2" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-2"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-3" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-3"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-4" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-4"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Refrigerator</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-5" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-5"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Dispenser</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-6" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-6"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">TV</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-7" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-7"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">3D Print</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-8" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="kwh-component-value-8"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="cost panel-container-item" id="cost">
            <div class="panel-section">
                <div class="panel-section-title">
                    <h5>Cost Electricity</h5>
                </div>
                <div class="panel-section-data">
                    <div class="header-table-kwh-component">
                        <table class="table">
                            <thead class="sticky-top" style="background-color: red;width:fit-content">
                                <tr>
                                    <th scope="col">Utility</th>
                                    <th colspan="2">Progress</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-1" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-1" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-2" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-2" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-3" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-3" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-4" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-4" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Refrigerator</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-5" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-5" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Dispenser</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-6" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-6" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">TV</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-7" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-7" class="value-component">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">3D Print</td>
                                    <td colspan="2">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-cost-8" class="progress-bar2">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cost-component-value-8" class="value-component">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="carbon panel-container-item" id="carbon">
            <div class="panel-section">
                <div class="panel-section-title">
                    <h5>Carbon Footprint</h5>
                </div>
                <div class="panel-section-data">
                    <table class="table">
                        <thead class="sticky-top" style="background-color: red;width:fit-content">
                            <tr>
                                <th scope="col">Utility</th>
                                <th colspan="2">Progress</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-1" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-1" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-2" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-2" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-3" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-3" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-4" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-4" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Refrigerator</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-5" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-5" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Dispenser</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-6" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-6" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">TV</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-7" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-7" class="value-component">
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">3D Print</td>
                                <td colspan="2">
                                    <div class="progress-bar-section">
                                        <div class="progress2 progress-moved">
                                            <div id="progress-bar-carbon-8" class="progress-bar2">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span id="carbon-component-value-8" class="value-component">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="status panel-container-item" id="status">
            <div class="panel-section">
                <div class="panel-section-title">
                    <h5>
                        Data Communication Status
                    </h5>
                </div>
                <div class="panel-section-data">
                    <div>
                        <table class="table">
                            <thead class="sticky-top" style="background-color: red;width:fit-content">
                                <tr>
                                    <th colspan="2">Utility</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-1</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-1"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-2</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-2"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-3</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-3"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="UtilWidth">Delabo Computer-4</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-4"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Refrigerator</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-5"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Dispenser</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-6"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">TV</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-7"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">3D Print</td>
                                    <td colspan="2">
                                        <span class="status_connection" id="status-8"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </ul>
                </div>
            </div>
        </div>
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
        <div class="Smartplug-1 chartContainer" id="responsecontainer"></div>

        <script>
            var refreshId;
            var firstLoad = true; // Tambahkan variabel untuk melacak apakah ini adalah load pertama kali
            var status = true;
            var intervalId;

            var chartId = 1;

            $(document).ready(function() {
                localStorage.setItem('chart', 1);
                if (!chartId) {
                    localStorage.setItem('chart', 1);
                }

                $('.smartplug-toggle').on('change', function() {
                    var demovalue = $(this).val();
                    localStorage.setItem('chart', demovalue);
                    startInterval()
                });
            });

            // Tampilkan tampilan loading saat load pertama kali
            showLoading();

            function startInterval() {
                document.getElementById("startInterval").classList.add("activeButton");
                document.getElementById("stopInterval").classList.remove("activeButton");
                if (status) {
                    status = true;
                    refreshId = setInterval(function() {
                        $('#responsecontainer').load(`./pages/energy-status/energy-status-component/charts.php?param=${chartId}`);
                        // $('#status').load('./pages/energy-status/energy-status-component/status-component.php');

                        $.ajax({
                            url: './pages/energy-status/energy-status-component/data.php',
                            type: 'GET',
                            success: function(data) {

                                var response = JSON.parse(data);

                                // Update the data
                                UpdateValue([response.SMARTPLUG_1, response.SMARTPLUG_2, response.SMARTPLUG_3, response.SMARTPLUG_4, response.SMARTPLUG_5, response.SMARTPLUG_6, response.SMARTPLUG_7, response.SMARTPLUG_8]);
                            }
                        });

                        $.ajax({
                            url: './pages/energy-status/energy-status-component/data-status.php',
                            type: 'GET',
                            success: function(data) {
                                var response = JSON.parse(data);
                                // Update the data
                                UpdateStatus([response.STATUS_1, response.STATUS_2, response.STATUS_3, response.STATUS_4, response.STATUS_5, response.STATUS_6, response.STATUS_7, response.STATUS_8]);
                            }
                        });

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
                document.getElementById("smartplug-status").style.display = 'block';
            }

            function UpdateValue(data) {
                for (let index = 1; index < 9; index++) {
                    document.getElementById(`progress-bar-${index}`).style.width = `${data[index-1].progress_bar}%`
                    document.getElementById(`kwh-component-value-${index}`).innerHTML = data[index - 1].progress_bar.toFixed(3);

                    document.getElementById(`progress-bar-cost-${index}`).style.width = `${data[index-1].cost}%`
                    document.getElementById(`cost-component-value-${index}`).innerHTML = data[index - 1].cost.toFixed(3);

                    document.getElementById(`progress-bar-carbon-${index}`).style.width = `${data[index-1].carbon_bar}%`
                    let dataCarbon = parseFloat(data[index - 1].carbon_bar).toFixed(3);
                    document.getElementById(`carbon-component-value-${index}`).innerHTML = dataCarbon;
                }
            }

            function UpdateStatus(data) {
                for (let index = 1; index < 9; index++) {
                    var theNumber = `status-${index}`
                    if (data[index - 1].status == "Online") {
                        document.getElementById(theNumber).innerHTML = "Online"
                        document.getElementById(theNumber).style.color = "green"
                    } else if (data[index - 1].status == "Idle") {
                        document.getElementById(theNumber).innerHTML = "Idle"
                        document.getElementById(theNumber).style.color = "blue"
                    } else if (data[index - 1].status == "Offline") {
                        document.getElementById(theNumber).innerHTML = "Offline"
                        document.getElementById(theNumber).style.color = "red"
                    }
                }
            }
        </script>
    </div>
</div>