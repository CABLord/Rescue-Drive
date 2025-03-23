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
    loggerContainer.className = "logger";

    // Den neuesten Log-Eintrag für die Darstellung im grafischen Container verwenden
    const latestEntry = data[data.length - 1]; // Falls keine Daten vorhanden sind, leeres Objekt

    // Logs in das Terminal einfügen
    data.forEach(entry => {
        const logEntry = document.createElement("div");
        logEntry.className = "log-entry";
        const timestamp = entry.TIMESTAMP || "Unbekannt";
        const logText = document.createElement("p");
        logText.textContent = `${timestamp} - WALL: ${entry.WALL}, CARD: ${entry.CARD}, POSITION: ${entry.POSITION}, BRIGHTNESS: ${entry.BRIGHTNESS}, MOVING_CARD: ${entry.MOVING_CARD}, DRIVE: ${entry.DRIVE}, LIGHT: ${entry.LIGHT}, AKKU: ${entry.AKKU}%, STATUS: ${entry.STATUS}`;
        logEntry.appendChild(logText);
        loggerContainer.appendChild(logEntry);
    });

    dashboard.appendChild(loggerContainer);

    // Warten, bis das Element im DOM gerendert wurde, dann scrollen
    setTimeout(() => {
        loggerContainer.scrollTop = loggerContainer.scrollHeight;
    }, 0);

    // Aktuellen Log-Eintrag grafisch anzeigen
    const currentLogContainer = document.getElementById("current-log");
    currentLogContainer.innerHTML = "";

    const graphicContainer = document.createElement("div");
    graphicContainer.className = "current-log";

    // Icons für verschiedene Statuswerte hinzufügen
    graphicContainer.appendChild(createIcon("fas fa-square", "Wand: " + (latestEntry.WALL || "none")));
    graphicContainer.appendChild(createIcon("fas fa-credit-card", "Karte: " + (latestEntry.CARD || "none")));
    graphicContainer.appendChild(createIcon("fas fa-map-marker-alt", "Position: " + (latestEntry.POSITION || "none")));
    graphicContainer.appendChild(createIcon("fas fa-sun", "Helligkeit: " + (latestEntry.BRIGHTNESS || "none")));
    graphicContainer.appendChild(createIcon("fas fa-sync-alt", "Bewegende Karte: " + (latestEntry.MOVING_CARD || "none")));
    graphicContainer.appendChild(createIcon("fas fa-car", "Fahrmodus: " + (latestEntry.DRIVE || "none")));
    graphicContainer.appendChild(createIcon("fas fa-lightbulb", "Licht: " + (latestEntry.LIGHT || "none")));
    graphicContainer.appendChild(createIcon("fas fa-battery-full", "Akkustand: " + (latestEntry.AKKU || "0") + "%"));
    graphicContainer.appendChild(createIcon("fas fa-circle", "Status: " + (latestEntry.STATUS || "none")));

    currentLogContainer.appendChild(graphicContainer);
}

// Hilfsfunktion zur Erstellung eines Icons mit Text
function createIcon(iconClass, text) {
    const container = document.createElement("div");
    container.className = "current-log-item";

    const icon = document.createElement("i");
    icon.className = iconClass; // Font Awesome Icon-Klasse

    const label = document.createElement("span");
    label.textContent = text;

    container.appendChild(icon);
    container.appendChild(label);

    return container;
}

// Daten alle 2 Sekunden abrufen
setInterval(fetchData, 2000);

// Logs löschen
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

// Initiale Datenabfrage beim Laden der Seite
document.addEventListener("DOMContentLoaded", fetchData);
