const messageElement = document.getElementById('message');
const serverApiUrl = "http://10.10.31.11:5000/control"; // Richtig: URL der REST-API auf deinem lokalen Server
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

        const data = await response.text();
        console.log("Response from server:", data);
    } catch (error) {
        console.error("Failed to send command:", error);
    }
}

function controlCar(direction) {
    if (lastCommand !== direction) {
        lastCommand = direction;
        messageElement.textContent = `The car is moving ${direction}`;
        sendToServer(direction);
    }
} 

function stopCar() {
    if (lastCommand !== "stop") {
        lastCommand = "stop";
        messageElement.textContent = "Use the arrow keys (↑←↓→) or WASD to control the vehicle";
        sendToServer("stop");
    }
}

function dropPackage() {
    if (lastCommand !== "drop") {
        lastCommand = "drop";
        messageElement.textContent = "A supply package has been successfully dropped!";
        sendToServer("drop");
    }
}

function activateMagnetDown() {
    if (lastCommand !== "magnet_down") {
        lastCommand = "magnet_down";
        messageElement.textContent = "Magnet nach unten aktiviert!";
        sendToServer("magnet_down");
    }
}

function setManualMode() {
    if (lastCommand !== "set_manual") {
        lastCommand = "set_manual";
        messageElement.textContent = "Auto wurde nach manuell umgeschaltet!";
        sendToServer("set_manual");
    }
    console.log("Switched to Manual Mode");
}

function setAutomaticMode() {
    if (lastCommand !== "set_automatic") {
        lastCommand = "set_automatic";
        messageElement.textContent = "Auto wurde nach automatisch umgeschaltet!";
        sendToServer("set_automatic");
    }
    console.log("Switched to Automatic Mode");
}