const express = require("express");
const cors = require("cors");
const axios = require("axios"); // Füge dies hinzu

const app = express();
app.use(express.json());
app.use(cors()); // Erlaubt Anfragen von deinem Frontend

const raspberryPiUrl = "http://192.168.88.96:4000/control"; // Ziel-API des Raspberry Pi

app.post("/control", async (req, res) => {
    const { command } = req.body;

    console.log(`Received command: ${command}`);

    try {
        const response = await axios.post(raspberryPiUrl, {
            command: command
        }, {
            headers: {
                "Content-Type": "application/json"
            }
        });

        res.send({ message: "Command forwarded to Raspberry Pi", response: response.data });
    } catch (error) {
        console.error("Error forwarding command:", error);
        res.status(500).send({ error: "Failed to forward command" });
    }
});

const PORT = 5000; // Oder ein anderer Port, falls nötig
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});