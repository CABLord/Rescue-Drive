const express = require("express");
const cors = require("cors");

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());  // CORS aktivieren, um Anfragen von anderen Ursprüngen zu akzeptieren
app.use(express.json());  // Damit JSON im Body der Anfrage geparst wird

// Beispiel für empfangene Nachrichten
let messages = [];

// POST-Endpunkt zum Empfangen von Befehlen
app.post("/api/receive-command", (req, res) => {
    const { command, status, source } = req.body;

    // Nachricht protokollieren und hinzufügen
    if (command && status && source) {
        console.log(`Received command: ${command}`);
        console.log(`Status: ${status}`);
        console.log(`Source: ${source}`);
        if (source === "Server") {
            // Hinzufügen der Nachricht zum Log nur Server
            messages.push({ type: 'outgoing', text: `Processed: ${command}` });
        } else if (source === "controlling server") {
            // Hinzufügen der Nachricht zum Log als Steuerung
            messages.push({ type: 'incoming', text: `Received command: ${command}` });
            messages.push({ type: 'outgoing', text: `Processed command: ${command}` });
        } else () =>
            console.log("Keine Gültige Herkumpft!");
        return res.status(200).json({ message: "Command received and processed", data: messages });
    } else {
        return res.status(400).json({ error: "Invalid data" });
    }
});

// GET-Endpunkt zum Abrufen der Nachrichten
app.get("/api/get-messages", (req, res) => {
    res.json(messages);
});

// Server starten
app.listen(PORT, () => {
    console.log(`Node.js server is running on http://localhost:${PORT}`);
});
