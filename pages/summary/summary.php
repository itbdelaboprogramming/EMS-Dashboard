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
                <div class="total-cost">
                    <div class="value">IDR <span id="total-cost" class="total-cost detail-value">0</span></div>
                    <div class="subtitle">Total Cost</div>
                </div>
                <div class="total-consomption">
                    <div class="value"><span id="total-consumption" class="total-consumption detail-value">0</span> kWh</div>
                    <div class="subtitle">Total Consumption</div>
                </div>
                <div class="total-carbon-emission">
                    <div class="value"><span id="total-carbon" class="total-carbon detail-value">0</span> kgCO<sup>2</sup></div>
                    <div class="subtitle">Total Carbon Emission</div>
                </div>
            </div>
        </div>
        <br>
        <div class="graph-section ">
            <div class="option-section ">
                <form id="date-range-form-chart">
                    <div class="flex form">
                        <div>
                            <label for="interval-chart">Interval:</label>
                            <select name="interval-chart" id="interval-chart">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="custom-chart">Custom</option>
                            </select>
                        </div>
                        <div id="customInterval-chart" style="display: none;">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" name="start_date" id="startDate">
                            <br>
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" name="end_date" id="endDate">
                            <br>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="chart">
                <div class="panel panel-primary" id="chartku" style="height:45vh; width:100%">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        var chart;

        function changeInterval() {
            var interval = document.getElementById('interval').value;
            var customInterval = document.getElementById('custom-interval');
            if (interval == 'custom') {
                customInterval.style.display = 'block';
            } else {
                customInterval.style.display = 'none';
            }
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

                // Send AJAX request
                $.ajax({
                    url: './pages/summary/detail-query.php',
                    type: 'post',
                    data: formData,
                    success: function(data) {

                        var response = JSON.parse(data);
                        console.log("responnse ", response);

                        // Update the chart
                        updateDetail(response.total_current, response.total_electricity, response.total_carbon);
                    }
                });
            });

            // Function to update the chart
            function updateDetail(current, electricity, carbon) {
                // Get the canvas element
                current = parseFloat(current)
                // electricity = parseFloat(electricity)
                carbon = parseFloat(carbon)


                var tempElectricity = 0;
                for (let i = 0; i < electricity.length; i++) {
                    if (!isNaN(electricity[i]) && electricity[i] !== null) {
                        console.log(i);
                        console.log(electricity[i]);
                        tempElectricity + parseFloat(electricity[i]);
                    }
                }

                let newCurrent = current.toFixed(2)
                let newElectricity = tempElectricity.toFixed(2)
                let newCarbon = carbon.toFixed(2)

                if (isNaN(current) == true) {
                    newCurrent = 0
                }
                if (isNaN(electricity) == true) {
                    newElectricity = 0
                }
                if (isNaN(carbon) == true) {
                    newCarbon = 0
                }

                document.getElementById('total-cost').innerText = newCurrent
                document.getElementById('total-consumption').innerText = newElectricity
                document.getElementById('total-carbon').innerText = newCarbon
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


            $('#date-range-form-chart').submit(function(event) {
                event.preventDefault();

                // Get form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: './pages/summary/chart-query.php',
                    type: 'post',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);

                        chart.destroy()


                        // Menggambar chart menggunakan Chart.js


                        for (var i = 0; i < data.timeData1.length; i++) {
                            var point = {
                                x: data.timeData1[i],
                                y: data.data1[i]
                            };
                            dataTable1.push(point);
                        }

                        for (var i = 0; i < data.timeData2.length; i++) {
                            var point = {
                                x: data.timeData2[i],
                                y: data.data2[i]
                            };
                            dataTable2.push(point);
                        }

                        for (var i = 0; i < data.timeData3.length; i++) {
                            var point = {
                                x: data.timeData3[i],
                                y: data.data3[i]
                            };
                            dataTable3.push(point);
                        }

                        for (var i = 0; i < data.timeData4.length; i++) {
                            var point = {
                                x: data.timeData4[i],
                                y: data.data4[i]
                            };
                            dataTable4.push(point);
                        }

                        for (var i = 0; i < data.timeData5.length; i++) {
                            var point = {
                                x: data.timeData5[i],
                                y: data.data5[i]
                            };
                            dataTable5.push(point);
                        }

                        for (var i = 0; i < data.timeData6.length; i++) {
                            var point = {
                                x: data.timeData6[i],
                                y: data.data6[i]
                            };
                            dataTable6.push(point);
                        }

                        for (var i = 0; i < data.timeData7.length; i++) {
                            var point = {
                                x: data.timeData7[i],
                                y: data.data7[i]
                            };
                            dataTable7.push(point);
                        }

                        for (var i = 0; i < data.timeData8.length; i++) {
                            var point = {
                                x: data.timeData8[i],
                                y: data.data8[i]
                            };
                            dataTable8.push(point);
                        }

                        for (var i = 0; i < data.timeData9.length; i++) {
                            var point = {
                                x: data.timeData9[i],
                                y: data.data9[i]
                            };
                            dataTable9.push(point);
                        }


                        chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                datasets: [{
                                        label: 'Delabo Computer-1',
                                        data: dataTable1,
                                        backgroundColor: '#2196F3',
                                        borderColor: '#2196F3',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Delabo Computer-2',
                                        data: dataTable2,
                                        backgroundColor: '#F44336',
                                        borderColor: '#F44336',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Delabo Computer-3',
                                        data: dataTable3,
                                        backgroundColor: '#4CAF50',
                                        borderColor: '#4CAF50',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Delabo Computer-4',
                                        data: dataTable4,
                                        backgroundColor: '#FFEB3B',
                                        borderColor: '#FFEB3B',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Refrigerator',
                                        data: dataTable5,
                                        backgroundColor: '#FF9800',
                                        borderColor: '#FF9800',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Dispenser',
                                        data: dataTable6,
                                        backgroundColor: '#9C27B0',
                                        borderColor: '#9C27B0',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'TV',
                                        data: dataTable7,
                                        backgroundColor: '#9E9E9E',
                                        borderColor: '#9E9E9E',
                                        borderWidth: 1
                                    },
                                    {
                                        label: '3D Print',
                                        data: dataTable8,
                                        backgroundColor: '#E91E63',
                                        borderColor: '#E91E63',
                                        borderWidth: 1
                                    },
                                ]
                            },
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
                    }
                })
            })
        });
    </script>


</body>