if (document.body.classList.contains('dark-theme')) {
    var element = document.getElementById('btn-dark-theme');
    if (typeof(element) != 'undefined' && element != null) {
      document.getElementById('btn-dark-theme').checked = true;
    }
  } else {
    var element = document.getElementById('btn-light-theme');
    if (typeof(element) != 'undefined' && element != null) {
      document.getElementById('btn-light-theme').checked = true;
    }
  }

  function changeTheme() {
    var lightThemeRadio = document.getElementById('btn-light-theme');
    var navbarElement = document.querySelector('.navbar');
    var sidebarElement = document.querySelector('.offcanvas');
    var side = document.querySelector('.side');

    if (lightThemeRadio.checked) {
        document.body.classList.remove('dark-theme');
        navbarElement.classList.remove('navbar-dark');
        navbarElement.classList.remove('bg-black');
        sidebarElement.classList.remove('bg-black');
        side.classList.remove("navbar-dark");
    } else {
        document.body.classList.add('dark-theme');
        navbarElement.classList.add('navbar-dark');
        navbarElement.classList.add('bg-black')
        sidebarElement.classList.add('bg-black');
        side.classList.add("navbar-dark");
    }
}
