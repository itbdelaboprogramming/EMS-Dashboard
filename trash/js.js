function transition(genreName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(genreName).style.display = "block";
    return tablinks
}

function openTab(evt, genreName) {
    transition(genreName)
    evt.currentTarget.className += " active";
}

function tabLink(genreName) {
    var tablinks = transition(genreName)
    for (i = 0; i < tablinks.length; i++) {
        if (tablinks[i].innerHTML == genreName) {
            tablinks[i].className += " active"
        }
    }
}
