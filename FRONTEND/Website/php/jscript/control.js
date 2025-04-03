const messageElement = document.getElementById('command');
const serverApiUrl = document.location.protocol + "//" + document.location.host + "/server_control.php"; 
let lastCommand = null;

async function sendToServer(command) {
    try {
        const response = await fetch(serverApiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ command })
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        const data = await response.json();
        console.log("Response from server:", data);
    } catch (error) {
        console.error("Failed to send command:", error);
    }
}

function controlCar(direction) {
    if (lastCommand !== direction) {
        lastCommand = direction;
        
        // Prüfen, ob die Richtung 'turn' ist
        if (direction === "leftTurn") {
            messageElement.textContent = "The car is turning";  // Tabulator und spezifische Nachricht für 'turn'
        } else {
            messageElement.textContent = `The car is moving ${direction}`;  // Standardnachricht für andere Richtungen
        }
        
        sendToServer(direction);
    }
} 

function stopCar() {
    if (lastCommand !== "stop") {
        lastCommand = "stop";
        messageElement.innerHTML = "Car is stopped";
        sendToServer("stop");
    }
}

// Steuerung per Tastatur hinzufügen
document.addEventListener("keydown", function (event) {
    switch (event.key.toLowerCase()) {
        case "arrowup":
        case "w":
            controlCar("forward");
            break;
        case "arrowleft":
        case "a":
            controlCar("left");
            break;
        case "arrowdown":
        case "s":
            controlCar("backward");
            break;
        case "arrowright":
        case "d":
            controlCar("right");
            break;
        case "q":
            controlCar("turn"); // Umdrehen
            break;
        case "e":
            dropPackage(); // Paket abwerfen
            break;
        case "f":
            activateMagnetDown(); // Magnet aktivieren
            break;
    }
});

document.addEventListener("keyup", function () {
    stopCar();
});

function dropPackage() {
    if (lastCommand !== "drop") {
        lastCommand = "drop";
        messageElement.textContent = "Package dropped!";
        sendToServer("dropCard");
    }
}

function activateMagnetDown() {
    if (lastCommand !== "magnet_down") {
        lastCommand = "magnet_down";
        messageElement.textContent = "Magnet is activated!";
        sendToServer("pickupCard");
    }
}

function setManualMode() {
    if (lastCommand !== "set_manual") {
        lastCommand = "set_manual";
        messageElement.textContent = "Switched to Manual Mode!";
        sendToServer("set_manual");
    }
    console.log("Switched to Manual Mode");
}

function setAutomaticMode() {
    if (lastCommand !== "set_automatic") {
        lastCommand = "set_automatic";
        messageElement.textContent = "Switched to Automatic Mode!";
        sendToServer("set_automatic");
    }
    console.log("Switched to Automatic Mode");
}

