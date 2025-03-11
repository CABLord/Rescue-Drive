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

    data.forEach(entry => {
        const card = document.createElement("div");
        card.className = "card my-3";

        Object.entries(entry).forEach(([key, value]) => {
            const p = document.createElement("p");
            p.innerHTML = `<strong>${key}:</strong> ${value}`;
            card.appendChild(p);
        });

        dashboard.appendChild(card);
    });
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