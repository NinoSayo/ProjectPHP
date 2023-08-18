function changeTheme() {
    var lightTheme = document.getElementById("btn-light-theme");
    var darkTheme = document.getElementById("btn-dark-theme");
    var pageElement = document.body;

    if (lightTheme.checked) {
        pageElement.style.backgroundColor = "white";
        pageElement.style.color = "black";
    } else if (darkTheme.checked) {
        pageElement.style.backgroundColor = "black";
        pageElement.style.color = "white";
    }
}
