let lastcomment = null; // Last sent command

const messageElement = document.getElementById('message');
let apiUrl = localStorage.getItem('raspberryIp') || "http://10.10.30.128:4000/control";

// Funktion zum Speichern der IP-Adresse
function saveIp() {
    const ipInput = document.getElementById("raspberryIp").value.trim();
    if (ipInput) {
        localStorage.setItem("raspberryIp", `http://${ipInput}:4000/control`);
        apiUrl = `http://${ipInput}:4000/control`;
        alert("IP gespeichert: " + apiUrl);
    } else {
        alert("Bitte eine gültige IP-Adresse eingeben.");
    }
}

// Falls eine IP gespeichert ist, setze den Wert im Input-Feld
document.addEventListener("DOMContentLoaded", () => {
    const savedIp = localStorage.getItem("raspberryIp");
    if (savedIp) {
        document.getElementById("raspberryIp").value = savedIp.replace("http://", "").replace(":4000/control", "");
    }
});

// API-Anfrage mit der gespeicherten IP-Adresse
async function sendRequestToAPI(command) {
    try {
        const response = await fetch(apiUrl, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ command })
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        const data = await response.text();
        console.log(data);
    } catch (error) {
        console.error("Failed to send command:", error);
    }
}


const directions = {
    'forward': 'w',
    'backward': 's',
    'left': 'a',
    'right': 'd'
};

function controlCar(direction) {
    if (lastcomment !== direction) {
        lastcomment = direction;
        messageElement.textContent = `The car is moving ${direction}`;
        sendRequestToAPI(direction);
    }
}

function stopCar() {
    if (lastcomment !== "stop") {
        lastcomment = "stop";
        messageElement.textContent = "Use the arrow keys (↑←↓→) or WASD to control the vehicle";
        sendRequestToAPI("stop");
    }
}

// Function to drop a supply package
function dropPackage() {
    if (lastcomment !== "drop") {
        lastcomment = "drop";
        messageElement.textContent = "A supply package has been successfully dropped!";
        sendRequestToAPI("drop");
    }
}

/*function activateMagnetUp() {
    if (lastcomment !== "magnet_up") {
        lastcomment = "magnet_up";
        messageElement.textContent = "Magnet nach oben aktiviert!";
        sendRequestToAPI("magnet_up");
    }
}*/

function activateMagnetDown() {
    if (lastcomment !== "magnet_down") {
        lastcomment = "magnet_down";
        messageElement.textContent = "Magnet nach unten aktiviert!";
        sendRequestToAPI("magnet_down");
    }
}
function setManualMode() {
    if (lastcomment !== "set_manual") {
        lastcomment = "set_manual";
        messageElement.textContent = "Auto wurde nach manuell umgeschaltet!";
        sendRequestToAPI("set_manual");
    }
    console.log("Switched to Manual Mode");
}

function setAutomaticMode() {
    if (lastcomment !== "set_automatic") {
        lastcomment = "set_automatic";
        messageElement.textContent = "Auto wurde nach automatisch umgeschaltet!";
        sendRequestToAPI("set_automatic");
    }
    console.log("Switched to Manual Mode");
}


const keyDirections = {
    'ArrowUp': 'forward',
    'ArrowDown': 'backward',
    'ArrowLeft': 'left',
    'ArrowRight': 'right',
    'w': 'forward',
    's': 'backward',
    'a': 'left',
    'd': 'right'
};

document.addEventListener('keydown', (event) => {
    if (event.key === 'e') {
        dropPackage();
    } else if (keyDirections[event.key]) {
        event.preventDefault();
        controlCar(keyDirections[event.key]);
    }
});

document.addEventListener('keyup', (event) => {
    if (Object.keys(keyDirections).includes(event.key)) {
        stopCar();
    } else if (event.key === "e") {
        stopCar();
    }
}); 

document.addEventListener('touchmove', (e) => e.preventDefault(), { passive: false });