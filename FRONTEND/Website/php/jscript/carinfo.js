document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggle-button");
    const bauteileContainer = document.getElementById("bauteile-container");

    // Falls das Element initial hidden ist, stellt es sicher, dass die Anzeige beim Laden korrekt funktioniert
    bauteileContainer.style.display = "none";  // Standardmäßig versteckt

    toggleButton.addEventListener("click", function () {
        const isHidden = bauteileContainer.style.display === "none";
        
        // Zeige/Verstecke das Element
        bauteileContainer.style.display = isHidden ? "flex" : "none";
        
        // Ändere den Text des Buttons je nach Zustand
        toggleButton.innerHTML = isHidden
            ? '<span>🔧</span> Bauteile ▲'
            : '<span>🔧</span> Bauteile ▼';
    });
});
