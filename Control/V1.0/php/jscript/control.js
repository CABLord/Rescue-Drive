const messageElement = document.getElementById('message');
const apiUrl = "http://10.10.30.128:4000/control"; // Replace with your Raspberry Pi's IP and port
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

        const data = await response.json();
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

// Add event listener to button if it exists
document.addEventListener("DOMContentLoaded", () => {
    const dropButton = document.getElementById("dropButton");
    if (dropButton) {
        dropButton.addEventListener("click", dropPackage);
    }
});

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
