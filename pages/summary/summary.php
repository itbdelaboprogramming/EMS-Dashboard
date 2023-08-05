<head>
    <link rel="stylesheet" href="./pages/summary/summary.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="summary-pages">
        <div class="detail-section">
            <div class="option-section ">
                <form id="date-range-form-detail">
                    <div class="flex form">
                        <div>
                            <label for="interval">Interval:</label>
                            <select name="interval" id="interval">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="last_year">Last Year</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div id="customInterval" style="display: none;">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" name="start_date" id="startDate">
                            <br>
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" name="end_date" id="endDate">
                            <br>
                        </div>
                        <br>
                        <div class="">
                            <label for="utility">Utility:</label>
                            <select name="utility" id="utility">
                                <option value="all" selected>All</option>
                                <option value="tuya_smart_plug_1">Delabo Computer-1</option>
                                <option value="tuya_smart_plug_2">Delabo Computer-2</option>
                                <option value="tuya_smart_plug_3">Delabo Computer-3</option>
                                <option value="tuya_smart_plug_4">Delabo Computer-4</option>
                                <option value="tuya_smart_plug_5">Refrigerator</option>
                                <option value="tuya_smart_plug_6">Dispenser</option>
                                <option value="tuya_smart_plug_7">TV</option>
                                <option value="tuya_smart_plug_8">3D Print</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="flex detail">
                <div class="total-cost div-button" onclick="detailInformation('total_cost')">
                    <div class="value">IDR <span id="total-cost" class="total-cost detail-value">0</span></div>
                    <div class="subtitle">Total Cost</div>
                </div>
                <div class="total-consomption div-button" onclick="detailInformation('electricity')">
                    <div class="value"><span id="total-consumption" class="total-consumption detail-value">0</span> kWh</div>
                    <div class="subtitle">Total Consumption</div>
                </div>
                <div class="total-carbon-emission div-button" onclick="detailInformation('carbon')">
                    <div class="value"><span id="total-carbon" class="total-carbon detail-value">0</span> kgCO<sup>2</sup></div>
                    <div class="subtitle">Total Carbon Emission</div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="graph-section ">
            <div class="chart">
                <div class="panel panel-primary" id="chartku" style="height:45vh; width:100%">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        let chart, interval = 'daily',
            startDate, endDate, utility;

        let timeData = []
        let dataDetail = []

        function changeInterval() {
            var interval = document.getElementById('interval').value;
            var customInterval = document.getElementById('custom-interval');
            if (interval == 'custom') {
                customInterval.style.display = 'block';
            } else {
                customInterval.style.display = 'none';
            }
        }

        function detailInformation(status) {
            console.log(utility);
            // Send AJAX request
            $.ajax({
                url: './pages/summary/chart-query.php',
                type: 'post',
                data: {
                    status: status,
                    startDate: startDate,
                    endDate: endDate,
                    interval: interval,
                    utility: utility,
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    console.log(response);
                    // Update the chart
                }
            });
        }

        $(document).ready(function() {
            var ctx = document.getElementById('myChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'bar',
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            $("#interval").change(function() {
                if ($(this).val() === "custom") {
                    $("#customInterval").show();
                } else {
                    $("#customInterval").hide();
                }
            });

            $("#interval-chart").change(function() {
                if ($(this).val() === "custom-chart") {
                    $("#customInterval-chart").show();
                } else {
                    $("#customInterval-chart").hide();
                }
            });

            // Handle form submission
            $('#date-range-form-detail').submit(function(event) {
                event.preventDefault();

                // Get form data
                var formData = $(this).serialize();

                var array_form = formData.split("&")

                var start_date_array = array_form[1]
                start_date_array = start_date_array.split("=")
                startDate = start_date_array[1]

                var end_date_array = array_form[2]
                end_date_array = end_date_array.split("=")
                endDate = end_date_array[1]

                var interval_array = array_form[0]
                interval_array = interval_array.split("=")
                interval = interval_array[1]

                var utility_array = array_form[3]
                utility = utility_array.split("=")
                utility = utility[1]

                // Send AJAX request
                $.ajax({
                    url: './pages/summary/detail-query.php',
                    type: 'post',
                    data: formData,
                    success: function(data) {
                        var response = JSON.parse(data);

                        // Update the chart
                        updateDetail(response.total_cost, response.total_electricity, response.total_carbon);
                    }
                });
            });

            // Function to update the chart
            function updateDetail(current, electricity, carbon) {
                // Get the canvas element
                current = parseFloat(current)
                electricity = parseFloat(electricity)
                carbon = parseFloat(carbon)

                document.getElementById('total-cost').innerText = current.toFixed(3)
                document.getElementById('total-consumption').innerText = electricity.toFixed(3)
                document.getElementById('total-carbon').innerText = carbon.toFixed(3)
            }

            var dataTable1 = [];
            var dataTable2 = [];
            var dataTable3 = [];
            var dataTable4 = [];
            var dataTable5 = [];
            var dataTable6 = [];
            var dataTable7 = [];
            var dataTable8 = [];
            var dataTable9 = [];
        });
    </script>


</body>