document.addEventListener('DOMContentLoaded', function () {
    var themePreference = localStorage.getItem('theme');

    if (themePreference === 'dark-theme') {
        applyDarkTheme();
    } else if (themePreference === 'light-theme') {
        applyLightTheme();
    } else {
        // Default to a theme if no preference is found in local storage
        applyDarkTheme(); // or applyLightTheme() based on your preference
    }
});

function applyDarkTheme() {
    var darkThemeRadio = document.getElementById('btn-dark-theme');
    var lightThemeRadio = document.getElementById('btn-light-theme');
    var navbarElement = document.querySelector('.navbar');
    var sidebarElement = document.querySelector('.offcanvas');
    var side = document.querySelector('.side');
    var card = document.querySelector('.card-theme');
    var table = document.querySelector('.table');

    darkThemeRadio.checked = true;

    document.body.classList.add('dark-theme');
    navbarElement.classList.replace('navbar-light', 'navbar-dark');
    navbarElement.classList.replace('bg-light', 'bg-dark');
    sidebarElement.classList.add('bg-dark');
    side.classList.add("navbar-dark");
    card.classList.add('bg-dark');
    if(table){
    table.classList.add('text-white');
    }
}

function applyLightTheme() {
    var darkThemeRadio = document.getElementById('btn-dark-theme');
    var lightThemeRadio = document.getElementById('btn-light-theme');
    var navbarElement = document.querySelector('.navbar');
    var sidebarElement = document.querySelector('.offcanvas');
    var side = document.querySelector('.side');
    var card = document.querySelector('.card');
    var table = document.querySelector('.table');

    lightThemeRadio.checked = true;

    document.body.classList.remove('dark-theme');
    navbarElement.classList.replace('navbar-dark', 'navbar-light');
    navbarElement.classList.replace('bg-dark', 'bg-light');
    sidebarElement.classList.remove('bg-dark');
    side.classList.remove("navbar-dark");
    card.classList.remove('bg-dark');
    if(table){
    table.classList.remove('text-white');
    }
}

function changeTheme(theme) {
    if (theme === 'dark') {
        applyDarkTheme();
        localStorage.setItem('theme', 'dark-theme');
    } else {
        applyLightTheme();
        localStorage.setItem('theme', 'light-theme');
    }
}

