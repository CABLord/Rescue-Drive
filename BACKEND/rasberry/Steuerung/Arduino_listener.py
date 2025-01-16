import threading

from senttoServer import Sender
class Ardiuno_listener(threading.Thread):

    def __init__(self, name, arduino):
        super().__init__()
        self.name = name
        self.arduino = arduino
        self.sender = Sender("http://localhost:3000/api/receive-command");

    def run(self):
        while self.arduino.is_open:
            while self.arduino.in_waiting > 0:
                response = self.arduino.readline().decode('utf-8').strip()
                print(f"Antwort vom Arduino: {response}")
        print("Verbindung geschlossen.")
