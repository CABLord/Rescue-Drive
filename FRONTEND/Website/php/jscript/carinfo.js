document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggle-button");
    const bauteileContainer = document.getElementById("bauteile-container");

    toggleButton.addEventListener("click", function () {
        const isHidden = bauteileContainer.style.display === "none";
        bauteileContainer.style.display = isHidden ? "flex" : "none";
        toggleButton.innerHTML = isHidden
            ? '<span>🔧</span> Bauteile ▲'
            : '<span>🔧</span> Bauteile ▼';
    });
});