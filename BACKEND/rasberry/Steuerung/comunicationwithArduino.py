import serial
import time

# Arduino verbinden (COM-Port anpassen)
arduino_port = "COM5"  # Ersetze COM3 mit deinem Arduino-COM-Port
baud_rate = 9600       # Baudrate muss mit dem Arduino übereinstimmen

try:
    # Verbindung öffnen
    arduino = serial.Serial(arduino_port, baud_rate, timeout=1)
    time.sleep(2)  # Warten, bis Arduino bereit ist

    print("Verbindung hergestellt. Nachrichten werden gesendet!")

    def send_and_receive(message):
        """Nachricht an den Arduino senden und Antwort lesen"""
        arduino.write(f"{message}\n".encode())  # Nachricht senden
        time.sleep(0.1)  # Kurz warten, um Antwort zu empfangen
        while arduino.in_waiting > 0:
            response = arduino.readline().decode('utf-8').strip()
            print(f"Antwort vom Arduino: {response}")
    input1 = "default"
    # Nachrichten senden
    while input1 != "EXIT":
        input1 = input()
        send_and_receive(input1)    # Sends input from


except serial.SerialException as e:
    print(f"Fehler: {e}")
finally:
    if 'arduino' in locals() and arduino.is_open:
        arduino.close()  # Verbindung schließen
        print("Verbindung geschlossen.")
