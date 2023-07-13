var themeStatus = document.getElementById('theme_status')
var switchButton = document.querySelector('.switch');
var toggleSlider = document.querySelector('.toggle-slider');

function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
    if (themeName == 'dark-theme') {
        themeStatus.innerHTML = 'Dark Mode'
        switchButton.style.left = "20px"
    } else {
        themeStatus.innerHTML = 'Light Mode'
        switchButton.style.left = "5px"
    }
}


$(document).ready(function () {
    var theme = localStorage.getItem('theme');
    if (theme) {
        setTheme(theme);
    } else {
        // Atur tema default
        setTheme('light-theme');
    }

    toggleSlider.addEventListener('click', function () {
        // Menggunakan JavaScript untuk menangani perubahan status slider toggle
        var theme = localStorage.getItem('theme');
        var iconTheme = document.querySelector("#icon_theme")
        if (theme == "light-theme") {
            setTheme('dark-theme');
            iconTheme.classList.replace("fa-moon", "fa-sun");
        } else {
            setTheme('light-theme');
            iconTheme.classList.replace("fa-sun", "fa-moon");
        }
    })
});

