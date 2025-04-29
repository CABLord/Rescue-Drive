
from flask import Flask, request, jsonify
from flask_cors import CORS
import requests  # Für HTTP-Anfragen (zum Senden der Antwort)
import time
import serial
from Arduino_listener import ArdiunoListener
from Listenersmall import Listenersmall
from Sender import send_json  # Sender for extern server
from DATA import DATA
from datetime import datetime

app = Flask(__name__)
CORS(app)

VALID_COMMANDS = ["forward", "backward", "left", "right", "stop", "leftTurn", "pickupCard", "dropCard", "set_manual", "set_automatic"]

@app.route("/")#standard default route
def test():
	return "Hello"

@app.route('/data', methods=['GET'])#Default for getting data(logs) from the server
def get_data():
    data = {
        "message": DATA.data,
        "status": "success"
    }
    return jsonify(data)  # JSON-Antwort zurückgeben

@app.route('/control', methods=['POST'])
def control():
    """API-Endpunkt zum Empfangen von Steuerbefehlen."""
    data = request.get_json()
    command = data.get("command", "")

    if command not in VALID_COMMANDS:#control command check
        return jsonify({"error": "Invalid command"}), 400

    """drive mode change """
    if(command == "set_automatic"):
        dataclass.steuerung_aut = True
        arduino.write(("stop" + "\n").encode())
        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "auto"}) 
    elif(command == "set_manual"):
        dataclass.steuerung_aut = False
        arduino.write(("stop" + "\n").encode())
        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "manual"}) 
    else:
        arduino.write((command + "\n").encode())
    print(f"Received command: {command}")#debugging print
    return jsonify({"command":"Erfolg"})##success message

if __name__ == "__main__":
    # Server Start
    try:
        dataclass = DATA
        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "ON"}) 
        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "manual"})
        # Arduino connection (COM-Port /Serial Port)
        arduino_port1 = "/dev/ttyACM1"  #  Arduino-COM-Port
        arduino_port2= "/dev/ttyACM0"  # alt. Arduino-COM-Port
        baud_rate = 9600  # 
        # make conection
        try:
            arduino = serial.Serial(arduino_port1, baud_rate, timeout=1)
        except (serial.SerialException, FileNotFoundError) as e1:
            arduino = serial.Serial(arduino_port2, baud_rate, timeout=1)
        arduino.write("drivemode=t\n".encode())

        time.sleep(2)  # Waits Arduino is ready
        
        """starts the thread for the Arduino listener"""
        thread1 = ArdiunoListener(arduino, dataclass)
        thread1.start() 
        """
        thread2 = Listenersmall(arduino, dataclass)
        thread2.start() """

        print("Starting Server...\n")
        app.run(host="0.0.0.0", port=4000, debug=False)

    except KeyboardInterrupt:
        print("\nServer beendet...")

    except serial.SerialException as e:
        print(f"Fehler: {e}")
    finally:
        #on close set status to default
        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "ON"}) 
        time.sleep(1)
        if 'arduino' in locals() and arduino.is_open:
            arduino.close()  # Verbindung schließen
            print("Verbindung geschlossen.")
