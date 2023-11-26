<!DOCTYPE html>
<html lang="en">

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
                                <option value="yearly">Yearly</option>
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

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <span class="submit-tooltip ">Click to update</span>
                    </div>
                </form>
            </div>
            <div class="flex detail">
                <div class="total-cost div-button" onclick="detailInformation('total_cost')">
                    <div class="value">IDR <span id="total-cost" class="total-cost detail-value">0</span></div>
                    <div class="subtitle">Total Cost</div>
                    <span class="tooltip">Click for Detail</span>
                </div>
                <div class="total-consumption div-button" onclick="detailInformation('electricity')">
                    <div class="value"><span id="total-consumption" class="total-consumption detail-value">0</span> kWh</div>
                    <div class="subtitle">Total Consumption</div>
                    <span class="tooltip">Click for Detail</span>
                </div>
                <div class="total-carbon-emission div-button" onclick="detailInformation('carbon_emission')">
                    <div class="value"><span id="total-carbon" class="total-carbon detail-value">0</span> kgCO<sub>2</sub></div>
                    <div class="subtitle">Total Carbon Emission</div>
                    <span class="submit-tooltip">Click for Detail</span>
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
        //Option Section
        document.getElementById('interval').addEventListener('change', handleSelectChange);
        document.getElementById('utility').addEventListener('change', handleSelectChange);


        function handleSelectChange() {
            // Change the button color to green on select change
            const submitButton = document.querySelector('.btn.btn-primary');
            submitButton.style.backgroundColor = 'green';

            const theTooltip = document.querySelector('.submit-tooltip');
            theTooltip.style.opacity = 1;
            theTooltip.style.transition = 'all 0.4s ease';
        }

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
                    // Parse the JSON response
                    var response = JSON.parse(data);

                    if (utility == "all") {

                        // Mengubah nilai null menjadi 0 dalam array
                        for (var i = 0; i < response.length; i++) {
                            if (response[i] === null) {
                                response[i] = "0";
                            }
                        }

                        updateChart(response);

                    } else {
                        updateChart(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        let hourDaily = []
        let weekDates = [];
        let monthDates = [];
        const theMonths = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        let monthYearly = []
        let daysInMonth = 0

        function prepareDataWeekly(data) {

            hourDaily = [];
            if (interval == "daily") {
                for (let j = 0; j <= 24; j++) {
                    const hour = `${j < 10 ? '0' : ''}${j}:00:00`;
                    hourDaily.push(hour);
                }
            }

            weekDates = [];
            if (interval == "weekly") {
                const today = new Date();
                today.setDate(today.getDate() - today.getDay());

                // Create an array to hold all the dates in the week
                for (let i = 0; i < 7; i++) {
                    const date = new Date(today);
                    date.setDate(date.getDate() + i);
                    weekDates.push(date.toISOString().slice(0, 10)); // Push formatted dates (YYYY-MM-DD)
                }
            }

            monthDates = [];
            daysInMonth = 0
            // Find the today of the current month
            if (interval == "monthly") {
                const today = new Date();
                const year = today.getFullYear();
                const month = today.getMonth();

                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let i = 2; i <= daysInMonth + 1; i++) {
                    const date = new Date(year, month, i);
                    monthDates.push(date.toISOString().slice(0, 10));
                }

                return monthDates;
            }
        }

        function updateChart(data) {
            if (interval == "daily") {
                prepareDataWeekly(data)

                for (let i = 1; i <= 8; i++) {
                    let plugName = `tuya_smart_plug_${i}`;

                    if (data[0][plugName]) {
                        data[0][plugName].map((item, index) => {
                            const dateParts = item.tanggal.split(' '); // Split date and time
                            const timePart = dateParts[1]; // Extract time part
                            const formattedTime = `${timePart}:00:00`; // Format time as HH:00:00

                            data[0][plugName][index] = {
                                ...item,
                                tanggal: formattedTime,
                            }
                        })

                        hourDaily.forEach(date => {
                            const found = data[0][plugName].find(item => item.tanggal === date);
                            if (!found) {
                                data[0][plugName].push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });
                    }
                }

            }

            if (interval == "monthly") {
                prepareDataWeekly(data)

                for (let i = 1; i <= 8; i++) {
                    const plugName = `tuya_smart_plug_${i}`;
                    if (data[0][plugName]) {
                        monthDates.forEach(date => {
                            const found = data[0][plugName].find(item => item.tanggal === date);
                            if (!found) {
                                data[0][plugName].push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });
                    }
                }
            }

            if (interval == "weekly") {
                prepareDataWeekly(data)

                for (let i = 1; i <= 8; i++) {
                    const plugName = `tuya_smart_plug_${i}`;
                    if (data[0][plugName]) {
                        weekDates.forEach(date => {
                            const found = data[0][plugName].find(item => item.tanggal === date);
                            if (!found) {
                                data[0][plugName].push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });
                    }
                }
            }


            if (interval == "yearly") {
                prepareDataWeekly(data)

                for (let i = 1; i <= 8; i++) {
                    let plugName = `tuya_smart_plug_${i}`;

                    if (data[0][plugName]) {
                        data[0][plugName].map((item, index) => {
                            for (let i = 1; i <= 12; i++) {
                                const found = data[0][plugName].find(item => item.tanggal === i.toString());
                                if (!found) {
                                    data[0][plugName].push({
                                        tanggal: i.toString(),
                                        total_total_cost: "0"
                                    });
                                }
                            }
                        });

                        data[0][plugName] = data[0][plugName]
                            .map(item => {
                                return {
                                    tanggal: theMonths[parseInt(item.tanggal) - 1],
                                    total_total_cost: item.total_total_cost
                                };
                            })
                            .sort((a, b) => {
                                return theMonths.indexOf(a.tanggal) - theMonths.indexOf(b.tanggal);
                            });
                    }
                }
            }

            let responseData = data

            if (chart) {
                chart.destroy()
            }

            var ctx = document.getElementById('myChart').getContext('2d');

            var labels = [];

            labels = [startDate]

            if (utility == "all") {
                var response = data

                // Extract table names from the response
                var tableNames = Object.keys(response[0]);

                // Create datasets for each table
                var datasets = tableNames.map(function(tableName, index) {
                    var tableData = response[0][tableName];
                    var data = tableData.map(function(entry) {
                        if (entry.total_electricity) {
                            return parseFloat(entry.total_electricity);
                        } else if (entry.total_total_cost) {
                            return parseFloat(entry.total_total_cost);
                        } else if (entry.total_carbon_emission) {
                            return parseFloat(entry.total_carbon_emission);
                        }
                    });



                    tableName == "tuya_smart_plug_1" ? tableName = "Delabo Computer-1" : ""
                    tableName == "tuya_smart_plug_2" ? tableName = "Delabo Computer-2" : ""
                    tableName == "tuya_smart_plug_3" ? tableName = "Delabo Computer-3" : ""
                    tableName == "tuya_smart_plug_4" ? tableName = "Delabo Computer-4" : ""
                    tableName == "tuya_smart_plug_5" ? tableName = "Refrigerator" : ""
                    tableName == "tuya_smart_plug_6" ? tableName = "Dispenser" : ""
                    tableName == "tuya_smart_plug_7" ? tableName = "TV" : ""
                    tableName == "tuya_smart_plug_8" ? tableName = "3D Print" : ""

                    return {
                        label: tableName,
                        data: data,
                    };
                });

                // Extract dates from the first table's data
                var dates = response[0][tableNames[0]].map(function(entry) {
                    return entry.tanggal;
                });

                // console.log("datasets : ", datasets);
                // console.log("dates : ", dates);

                if (interval == "weekly") {
                    dates = weekDates
                }

                // Create the stacked bar chart
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets: datasets,
                    },
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
                });
            } else {

                if (interval == "daily") {
                    prepareDataWeekly(data)


                    if (responseData) {
                        responseData.map((item, index) => {
                            const dateParts = item.tanggal.split(' '); // Split date and time
                            const timePart = dateParts[1]; // Extract time part
                            const formattedTime = `${timePart}:00:00`; // Format time as HH:00:00

                            responseData[index] = {
                                ...item,
                                tanggal: formattedTime,
                            }
                        })

                        hourDaily.forEach(date => {
                            const found = responseData.find(item => item.tanggal === date);
                            if (!found) {
                                responseData.push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });

                    }

                }

                if (interval == "monthly") {
                    prepareDataWeekly(data)

                    if (responseData) {
                        monthDates.forEach(date => {
                            const found = responseData.find(item => item.tanggal === date);
                            if (!found) {
                                responseData.push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });

                    }
                }

                if (interval == "weekly") {
                    prepareDataWeekly(data)

                    const plugName = `tuya_smart_plug_${i}`;
                    if (responseData) {
                        weekDates.forEach(date => {
                            const found = responseData.find(item => item.tanggal === date);
                            if (!found) {
                                responseData.push({
                                    tanggal: date,
                                    total_total_cost: "0"
                                });
                            }
                        });

                    }
                }


                if (interval == "yearly") {
                    prepareDataWeekly(data)

                    if (responseData) {
                        responseData.map((item, index) => {
                            for (let i = 1; i <= 12; i++) {
                                const found = responseData.find(item => item.tanggal === i.toString());
                                if (!found) {
                                    responseData.push({
                                        tanggal: i.toString(),
                                        total_total_cost: "0"
                                    });
                                }
                            }
                        });

                        responseData = responseData
                            .map(item => {
                                return {
                                    tanggal: theMonths[parseInt(item.tanggal) - 1],
                                    total_total_cost: item.total_total_cost
                                };
                            })
                            .sort((a, b) => {
                                return theMonths.indexOf(a.tanggal) - theMonths.indexOf(b.tanggal);
                            });

                    }
                }


                // Extract dates and total electricity values
                var dates = responseData.map(function(entry) {
                    return entry.tanggal;
                });

                var totalElectricityValues = responseData.map(function(entry) {
                    if (entry.total_electricity) {
                        return parseFloat(entry.total_electricity);
                    } else if (entry.total_total_cost) {
                        return parseFloat(entry.total_total_cost);
                    } else if (entry.total_carbon_emission) {
                        return parseFloat(entry.total_carbon_emission);
                    }

                });

                // Create the stacked bar chart
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: `${measurement}`,
                            data: totalElectricityValues,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Customize the color
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }],
                    },
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
                    },
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

                const submitButton = document.querySelector('.btn.btn-primary');
                submitButton.style.backgroundColor = '';

                const submitTooltip = document.querySelector('.submit-tooltip');
                submitTooltip.style.opacity = 0;
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

    <!-- test git raihan -->
</body>

</html>