from flask import Flask, request, jsonify
from flask_cors import CORS
import requests  # Für HTTP-Anfragen (zum Senden der Antwort)

app = Flask(__name__)
CORS(app, resources={r"/control": {"origins": "*"}})

VALID_COMMANDS = ["forward", "backward", "left", "right", "stop"]
TARGET_RESPONSE_URL = "http://localhost:3000/api/receive-command"  # Ziel für die Antwort (Nodejs Server)

@app.route('/control', methods=['POST'])
def control():
    """API-Endpunkt zum Empfangen von Steuerbefehlen."""
    data = request.get_json()
    command = data.get("command", "").lower()

    if command not in VALID_COMMANDS:
        return jsonify({"error": "Invalid command"}), 400

    # Debug-Ausgabe (lokal)
    print(f"Received command: {command}")

    # Nachricht an eine externe Zielseite senden
    try:
        # Antwortdaten vorbereiten
        response_data = {
            "command": command,
            "status": "processed",
            "source": "controlling server"  # Zusätzliche Informationen
        }
        headers = {"Content-Type": "application/json"}

        # POST-Anfrage an die Ziel-Website senden
        response = requests.post(TARGET_RESPONSE_URL, json=response_data, headers=headers)

        # Überprüfung der Antwort von der Ziel-Website
        if response.status_code == 200:
            print("Successfully sent response to target website.")
            return jsonify({"status": "success", "target_response": response.json()})
        else:
            #Debug Error Ruckgabe
            print(f"Failed to send response. Status code: {response.status_code}")
            return jsonify({"error": "Failed to send response"}), 500
    except Exception as e:
        print(f"Error sending response: {e}")
        return jsonify({"error": "Internal server error"}), 500

def normsend(message):
    try:
        # Antwortdaten vorbereiten
        response_data = {
            "command": message,
            "status": "processed",
            "source": "Server"  # Zusätzliche Informationen
        }
        headers = {"Content-Type": "application/json"}

        # POST-Anfrage an die Ziel-Website senden
        response = requests.post(TARGET_RESPONSE_URL, json=response_data, headers=headers)

        # Überprüfung der Antwort von der Ziel-Website
        if response.status_code == 200:
            print("Successfully sent response to target website.")

        else:
            #Debug Error Ruckgabe
            print(f"Failed to send response. Status code: {response.status_code}")
    except Exception as e:
        print(f"Error sending response: {e}")


if __name__ == "__main__":
    #Server Start
    try:
        print("Starting Server...\n")
        normsend("startup!")
        app.run(host="0.0.0.0", port=4000, debug=False)

    except KeyboardInterrupt:
        print("\nServer beendet...")
