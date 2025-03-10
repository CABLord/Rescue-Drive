async function fetchData() {
    try {
        const response = await fetch("server.php");
        const data = await response.json();
        updateTable(data);
    } catch (error) {
        console.error("Fehler beim Abrufen der Daten:", error);
    }
}

function updateTable(data) {
    const tableBody = document.getElementById("data-body");
    tableBody.innerHTML = ""; // Alte Inhalte löschen

    data.forEach(entry => {
        const row = document.createElement("tr");

        Object.values(entry).forEach(value => {
            const cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tableBody.appendChild(row);
    });
}

setInterval(fetchData, 2000); // Alle 2 Sekunden Daten abrufen