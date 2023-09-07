<head>
    <script src="./pages/controller/controller.js"></script>
    <link rel="stylesheet" href="./pages/controller/controller.css">
</head>

<body>
    <div id="controller" class="tabcontent">
        <div class="controller_button_section">
            <div class="button_section">
                <h5>Delabo Computer-1</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton1" onclick="updateStatus(1)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>Delabo Computer-2</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton2" onclick="updateStatus(2)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>Delabo Computer-3</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton3" onclick="updateStatus(3)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>Delabo Computer-4</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton4" onclick="updateStatus(4)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>3D Print</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton5" onclick="updateStatus(5)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>Refrigerator</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton6" onclick="updateStatus(6)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>TV</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton7" onclick="updateStatus(7)">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="button_section">
                <h5>Dispenser</h5>
                <label class="switch">
                    <input type="checkbox" id="toggleButton8" onclick="updateStatus(8)">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </div>

</body>

<script>
    // Fungsi untuk mengambil data status dari database setiap 5 menit
    function fetchDataPeriodically() {
        setInterval(function() {
            // Mengirim permintaan AJAX untuk mengambil data status dari database
            var xhr = new XMLHttpRequest();
            xhr.open('GET', './pages/controller/get_status.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var statusData = JSON.parse(xhr.responseText);

                    // Memeriksa nilai status dan memperbarui toggle button sesuai dengan data yang diterima
                    for (var i = 1; i < statusData.length; i++) {
                        // var id = statusData[i].id;
                        var status = statusData[i - 1].status;
                        var checkbox = document.getElementById('toggleButton' + i);

                        if (status === 'online') {
                            checkbox.checked = true;
                        } else {
                            checkbox.checked = false;
                        }
                    }
                }
            };
            xhr.send();
        }, 10000); // 300000 milidetik = 5 menit
    }

    // Memanggil fungsi untuk mengambil data status dari database secara berkala saat halaman dimuat
    window.addEventListener('load', function() {
        fetchDataPeriodically();

        // Mendapatkan semua elemen toggleButton dan menambahkan event listener pada masing-masing
        var toggleButtons = document.querySelectorAll('[id^="toggleButton"]');
        toggleButtons.forEach(function(toggleButton) {
            toggleButton.addEventListener('change', function() {
                if (toggleButton.checked) {
                    console.log('Switch is on');
                    // Perform action when switch is on
                } else {
                    console.log('Switch is off');
                    // Perform action when switch is off
                }
            });
        });
    });
</script>