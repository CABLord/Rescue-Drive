const messageElement = document.getElementById('message');
const apiUrl = "http://10.10.30.128:4000/control"; // Replace with your Raspberry Pi's IP and porthttp://10.10.30.128:4000/control
let lastcomment = null; // Last sent command

async function sendRequestToAPI(command) {
    try {
        const response = await fetch(apiUrl, {
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
        console.log(data);
    } catch (error) {
        console.error("Failed to send command to the Raspberry Pi:", error);
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