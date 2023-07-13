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
                <div class="total-carbon-emission div-button" onclick="detailInformation('carbon_emission')">
                    <div class="value"><span id="total-carbon" class="total-carbon detail-value">0</span> kgCO<sub>2</sub></div>
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
            measurement,
            temp_status = "total_cost",
            startDate = "0",
            endDate = "0",
            utility = "all";

        const colors = [
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 99, 132, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(128, 128, 128, 0.7)',
            'rgba(255, 0, 0, 0.7)',
            'rgba(0, 128, 0, 0.7)'
        ];

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
            status == "total_cost" ? temp_status = "TOTAL COST" : ""
            status == "electricity" ? temp_status = "ELECTRICITY" : ""
            status == "carbon_emission" ? temp_status = "CARBON EMISSION" : ""

            status == "total_cost" ? measurement = "Total Cost (IDR)" : ""
            status == "electricity" ? measurement = "Energy (kWh)" : ""
            status == "carbon_emission" ? measurement = "Carbon Emission (kgCO2)" : ""


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
                    if (utility == "all") {
                        // console.log("GGGG", data);
                        var response = JSON.parse(data);

                        // Mengubah nilai null menjadi 0 dalam array
                        for (var i = 0; i < response.length; i++) {
                            if (response[i] === null) {
                                response[i] = "0";
                            }
                        }

                        // Mengubah semua nilai dalam array menjadi float
                        response = response.map((e) => parseFloat(e));
                        updateChart(response)

                    } else {
                        var response = JSON.parse(data);
                        updateChart(response)
                    }

                    // Update the chart

                }
            });
        }

        function updateChart(data) {
            let responseData = data
            if (chart) {
                chart.destroy()
            }

            var ctx = document.getElementById('myChart').getContext('2d');

            var labels = [];

            labels = [startDate]
            if (utility == "all") {

                const labels = Array.from({
                    length: 12
                }, (_, index) => `tuya_smart_plug_${index + 1}`);

                const data = {
                    labels: [`${startDate} - ${endDate}`],
                    datasets: [{
                            label: 'Delabo Computer-1',
                            data: [responseData[0]],
                            backgroundColor: colors[0],
                        },
                        {
                            label: 'Delabo Computer-2',
                            data: [responseData[1]],
                            backgroundColor: colors[1],
                        },
                        {
                            label: 'Delabo Computer-3',
                            data: [responseData[2]],
                            backgroundColor: colors[2],
                        },
                        {
                            label: 'Delabo Computer-4',
                            data: [responseData[3]],
                            backgroundColor: colors[3],
                        },
                        {
                            label: 'Refrigerator',
                            data: [responseData[4]],
                            backgroundColor: colors[4],
                        },
                        {
                            label: 'Dispenser',
                            data: [responseData[5]],
                            backgroundColor: colors[5],
                        },
                        {
                            label: 'TV',
                            data: [responseData[6]],
                            backgroundColor: colors[6],
                        },
                        {
                            label: '32 Print',
                            data: [responseData[7]],
                            backgroundColor: colors[7],
                        },
                        // {
                        //     label: 'Dataset 9',
                        //     data: [responseData[8]],
                        //     backgroundColor: colors[8],
                        // },
                    ]
                }

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Chart.js Bar Chart - Stacked'
                            },
                        },
                        responsive: true,
                        scales: {
                            x: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'Time'
                                }
                            },
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: `${measurement}`
                                },
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            },
                        },
                        animation: false,
                        interaction: {
                            intersect: false,
                        },
                    }
                };
                chart = new Chart(ctx, config)
            } else {
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `${temp_status}`,
                            data: [data[0].total_value],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true,
                                display: true,
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
                                    text: `${measurement}`
                                },
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            },
                            // title: {
                            //     display: true,
                            //     text: `${temp_status}`
                            // }
                        },
                        animation: false,
                        interaction: {
                            intersect: false,
                        },
                    }
                });
            }
        }

        // Function to update the chart
        function updateDetail(current, electricity, carbon) {
            // Get the canvas element
            current = parseFloat(current)
            electricity = parseFloat(electricity)
            carbon = parseFloat(carbon);

            !current ? document.getElementById('total-cost').innerText = 0 : document.getElementById('total-cost').innerText = current.toFixed(3);
            !electricity ? document.getElementById('total-consumption').innerText = 0 : document.getElementById('total-consumption').innerText = electricity.toFixed(3);
            !carbon ? document.getElementById('total-carbon').innerText = 0 : document.getElementById('total-carbon').innerText = carbon.toFixed(3);
        }

        $(document).ready(function() {
            var ctx = document.getElementById('myChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'bar',
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true
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

                if (chart) {
                    chart.destroy()

                    chart = new Chart(ctx, {
                        type: 'bar',
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    stacked: true,
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        }
                    });
                }



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

<!-- tess update-->
</body>