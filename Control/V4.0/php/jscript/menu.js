function toggleMenu() {
    var menu = document.getElementById("mobileMenu");
    if (menu.classList.contains("w3-show")) {
        menu.classList.remove("w3-show");
    } else {
        menu.classList.add("w3-show");
    }
}
