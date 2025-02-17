import threading
import time
import serial
from Arduino_listener import Ardiuno_listener

arduino_port = "COM5"  # Port to Arduino
baud_rate = 9600       # baud_rate must be equal to the br from the Arduino


def send_and_receive(message):
    """Sends message to Arduino"""
    arduino.write(f"{message}\n".encode())  # sends message

# make conection
arduino = serial.Serial(arduino_port, baud_rate, timeout=1)
time.sleep(2)  # Waits Arduino is ready
thread1 = Ardiuno_listener("Thread-1")
thread1.start()

input1 = "default"
while input1 != "EXIT":
    input1 = input()
    send_and_receive(input1)  #Sends command to arduino

print("Alle Threads sind beendet.")