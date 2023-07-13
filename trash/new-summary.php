<!DOCTYPE html>
<html>

<head>
    <title>Data Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <form id="date-range-form">
        <label for="interval">Interval:</label>
        <select name="interval" id="interval">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="custom">Custom</option>
        </select>
        <div id="customInterval" style="display: none;">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="startDate">
            <br>
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" name="end_date" id="endDate">
            <br>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="summary-pages">
        <div>
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            const data = []
            const label = []

            for (let index = 0; index < 100; index++) {
                let number = Math.floor(Math.random() * 100) + 1;
                data.push(number)
                number = Math.floor(Math.random() * 100) + 1;
                label.push(number)
            }

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: '# of Votes',
                        data: data,
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</body>

</html>