async function fetchData() {
    try {
        const response = await fetch("server.php");
        const data = await response.json();
        updateDashboard(data);
    } catch (error) {
        console.error("Fehler beim Abrufen der Daten:", error);
    }
}
 
function updateDashboard(data) {
    const dashboard = document.getElementById("dashboard");
    dashboard.innerHTML = ""; // Alte Inhalte löschen

    const loggerContainer = document.createElement("div");
    loggerContainer.className = "logger"; // Die Klasse für das Terminal-Look

    // Wir erwarten, dass data ein Array von Logs ist
    data.forEach(entry => {
        const logEntry = document.createElement("div");
        logEntry.className = "log-entry";

        // Prüfen, ob die erforderlichen Felder existieren
        const timestamp = entry.TIMESTAMP || "Unbekannt";
        const wall = entry.WALL || "none";
        const card = entry.CARD || "none";
        const position = entry.POSITION || "none";
        const brightness = entry.BRIGHTNESS || "none";
        const movingCard = entry.MOVING_CARD || "none";
        const drive = entry.DRIVE || "none";
        const light = entry.LIGHT || "none";
        const akku = entry.AKKU || "0";
        const status = entry.STATUS || "none";

        // Erstellt den Log-Eintrag als Text
        const logText = document.createElement("p");
        logText.textContent = `${timestamp} - WALL: ${wall}, CARD: ${card}, POSITION: ${position}, BRIGHTNESS: ${brightness}, MOVING_CARD: ${movingCard}, DRIVE: ${drive}, LIGHT: ${light}, AKKU: ${akku}%, STATUS: ${status}`;

        // Füge die entsprechenden Klassen hinzu
        if (wall === "none") {
            logEntry.classList.add("none-wall");
        } else {
            logEntry.classList.add("active-wall");
        }

        if (card === "none") {
            logEntry.classList.add("none-card");
        } else {
            logEntry.classList.add("active-card");
        }

        if (drive !== "none") {
            logEntry.classList.add("active-drive");
        }

        logEntry.appendChild(logText);
        loggerContainer.appendChild(logEntry);
    });

    dashboard.appendChild(loggerContainer);
}

// Daten alle 2 Sekunden abrufen
setInterval(fetchData, 2000);

async function deleteLogs() {
    try {
        const response = await fetch("server.php", {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        if (response.ok) {
            console.log("Logs erfolgreich gelöscht");
            updateDashboard([]);
        } else {
            console.log("Fehler beim Löschen der Logs");
        }
    } catch (error) {
        console.error("Fehler beim Löschen der Logs:", error);
    }
}