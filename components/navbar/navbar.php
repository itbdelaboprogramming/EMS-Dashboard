<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name"><img src="./assets/icons/electricity_logo.png" class="navbar-icon" alt=""></div>
        <div class="text logo-text">
            <span class="name">EMS</span>
            <span class="profession">Energy Monitoring System</span>
            <span class="work">Nakayama x ITB de Labo</span>
        </div>
    </div>
    <i class="fa-solid fa-bars" id="btn"></i>
    <div class="routing-menu">
        <ul class="nav-list">
            <li onclick="openTab(event, 'smartplug-status')">
                <a href="?page=smartplug-status" <?php if ($page == 'smartplug-status') echo 'class="active"'; ?>>
                    <i class="fa-solid fa-plug"></i>
                    <span class="links_name">Energy Status</span>
                </a>
                <span class="tooltip">Energy Status</span>
            </li>
            <li onclick="openTab(event, 'database-report')">
                <a href="?page=database-report" <?php if ($page == 'database-report') echo 'class="active"'; ?>>
                    <i class="fa-solid fa-calendar-day  fa-2xl"></i>
                    <span class="links_name">Database</span>
                </a>
                <span class="tooltip">Database Report</span>
            </li>
            <li onclick="openTab(event, 'summary')">
                <a href="?page=summary" <?php if ($page == 'summary') echo 'class="active"'; ?>>
                    <i class="fa-solid fa-clipboard-list  fa-2xl"></i>
                    <span class="links_name">Summary</span>
                </a>
                <span class="tooltip">Summary</span>
            </li>
            <li onclick="openTab(event, 'controller')">
                <a href="?page=controller" <?php if ($page == 'controller') echo 'class="active"'; ?>>
                    <i class="fa-solid fa-power-off  fa-2xl"></i>
                    <span class="links_name">Controller</span>
                </a>
                <span class="tooltip">Controller</span>
            </li>
        </ul>
    </div>

    <li class="toggle-slider-section" style="margin-left: auto;">
        <i class='fa-solid fa-moon icon_theme' id='icon_theme'></i>
        <span class="theme_status" id="theme_status"></span>
        <div class="toggle-slider" id="toggle-slider">
            <span class="tooltip">Theme Changer</span>
            <span class="switch" id="switch"></span>
        </div>
    </li>
</div>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("fa-bars", "fa-align-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("fa-align-right", "fa-bars"); //replacing the iocns class
        }
    }

    const body = document.querySelector('body');
    const nav = body.querySelector('nav')
    const toggle = body.querySelector(".toggle")
    const modeSwitch = body.querySelector(".toggle-switch")
    const modeText = body.querySelector(".mode-text");


    // toggle.addEventListener("click", () => {
    //     nav.classList.toggle("close");
    // })

    // modeSwitch.addEventListener("click", () => {
    //     body.classList.toggle("dark");

    //     if (body.classList.contains("dark")) {
    //         modeText.innerText = "Light mode";
    //     } else {
    //         modeText.innerText = "Dark mode";

    //     }
    // });
</script>