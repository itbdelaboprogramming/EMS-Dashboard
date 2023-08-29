<?php ?>

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
            <h5>Refrigerator</h5>
            <label class="switch">
                <input type="checkbox" id="toggleButton5" onclick="updateStatus(5)">
                <span class="slider"></span>
            </label>
        </div>
        <div class="button_section">
            <h5>Dispenser</h5>
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
            <h5>3D Print</h5>
            <label class="switch">
                <input type="checkbox" id="toggleButton8" onclick="updateStatus(8)">
                <span class="slider"></span>
            </label>
        </div>
    </div>
</div>

</body>

<script>
    const toggleButton = document.getElementById('toggleButton');
    toggleButton.addEventListener('change', function() {
        if (toggleButton.checked) {
            console.log('Switch is on');
            // Perform action when switch is on
        } else {
            console.log('Switch is off');
            // Perform action when switch is off
        }
    });
</script>