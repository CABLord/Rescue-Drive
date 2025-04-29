
import threading
import time
import math
from Sender import send_json  # Sender for extern server?
from datetime import datetime
from DATA import DATA

class ArdiunoListener(threading.Thread):
    def __init__(self, arduino, daten):
        super().__init__()
        self.dataclass = daten
        self.arduino = arduino
        self.lastlight = ""
        self.lastbrightness = ""
        self.lastakku = 999; 
        self.hasstarted = False  #kontrolles if second time on green
        self.leftadd = 0
        self.rightadd = 0
        self.lastcolor = "none"
        self.lastdrive = ""
        self.lastdrivenum = 0

    def run(self):
        num = 0
        
        while self.arduino.is_open:
            
            if(self.dataclass.steuerung_aut):#automatik mode
                self.arduino.write(("readColor" + "\n").encode())#read color sensor
                time.sleep(0.1)
                
                t0 = self.getSensordatafromArduino("COLOR")
                if (t0 != -1):
                    self.process_color(t0, "auto")
                self.arduino.write(("readLaser" + "\n").encode())#read distance sensor
                time.sleep(0.1)
                t0 = self.getSensordatafromArduino("DISTANCE")
                if (t0 != -1):
                   self.control_distance(t0)
                num += 1
                if (num %10 == 0):#every 20 times read the light and battery
                    if(num == 10):
                        self.arduino.write(("readLight" + "\n").encode())
                    elif(num == 20):
                        num = 0
                        #self.arduino.write(("readBattery" + "\n").encode())
            else:#not auto controll but gives all data to the logger
                time.sleep(0.1)
                num += 1
                if (num %10 == 0):#every 20 times read the light and battery
                    if(num == 10):
                        self.arduino.write(("readLight" + "\n").encode())
                    elif(num == 20):
                        num = 0
                       # self.arduino.write(("readBattery" + "\n").encode())
                self.arduino.write(("readColor" + "\n").encode())#read color sensor
                
                if (self.arduino.in_waiting > 0):
                    response = self.arduino.readline().decode('utf-8').strip()
                    key, _, value = response.partition(":")  # Safer than split(":")
                    value = value.strip()
                    if (key == "DRIVE"):
                        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "DRIVE":value})
                    elif (key == "COLOR"):
                        self.process_color(value, "manual")
                    elif (key == "MOVING_CARD"):
                        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD":value})
                    elif (key == "LIGHT"):
                        if (self.lastlight != value):#controll if the light value is changed
                            self.lastlight = value;
                            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "LIGHT":value})
                    elif (key == "BRIGHTNESS"):
                        if (self.lastbrightness != value):#controll if the brightness value is changed
                            self.lastbrightness = value;
                            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "BRIGHTNESS":value})
                    elif (key == "AKKU"):
                        if(self.lastakku != value):#controll if the battery value is changed
                            self.lastakku = value
                            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "AKKU":round(float(value))})
                    else:
                        #Debugging print for all other messages from Arduino
                        print({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "other":key + value})
        print("Verbindung geschlossen.")
    def getSensordatafromArduino(self, imkey):
        response = ""
        key = ""
        value = -1
        while self.arduino.in_waiting > 0:
            response = self.arduino.readline().decode('utf-8').strip()
            key, _, value = response.partition(":")  # Safer than split(":")
            if(imkey in key):#controll if message is from wished sensor
                break
            else:#logger for the not specifc sensor data
                value.strip()
                if(key == "DRIVE"):
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "DRIVE":value})
                    if(self.lastdrive == value):
                        self.lastdrivenum += 1
                        if(self.lastdrivenum > 10):
                            self.arduino.write(("stop" + "\n").encode())
                            self.arduino.write(("backward" + "\n").encode())
                            time.sleep(0.5)
                            if(value == "left"):
                                self.arduino.write(("right" + "\n").encode())
                                time.sleep(0.2)
                            elif(value == "right"):
                                self.arduino.write(("left" + "\n").encode())
                                time.sleep(0.2)
                    else:
                        self.lastdrivenum = 0
                        self.lastdrive = value
                elif(key == "MOVING_CARD"):
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD":value})
                elif(key == "LIGHT"):
                    if (self.lastlight != value):
                        self.lastlight = value
                        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "LIGHT":value})
                elif(key == "BRIGHTNESS"):
                    if (self.lastbrightness != value):
                        self.lastbrightness = value
                        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "BRIGHTNESS":value})
                elif (key == "AKKU"):
                    if(self.lastakku != value):
                        self.lastakku = value
                        send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "AKKU":round(float(value))})     
                else:
                    print({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "other": response})
                value = -1
        return value
    def delayed_function(self, delay_time,command):
        """ Simulate async function using threading.Timer """
        def send_stop():
            if(command == "drivemode=t" or command == "stop"):
                self.arduino.write((command +"\n").encode())  # Send message
            else:
                self.rightadd = 0
                self.leftadd = 0
                    
        timer = threading.Timer(delay_time, send_stop)
        timer.start()
    def process_color(self, color, mode):
        """ Process color commands """
        colors = color.split(",")
        redValue = int(colors[0])
        greenValue = int(colors[1])
        blueValue = int(colors[2])
        if(mode == "auto"):
            print(colors)
        if (redValue >= 200 and greenValue <= 200 and blueValue <= 200):
            if(mode == "auto"):
                self.arduino.write("stop\n".encode())
            color = "RED"
            
        elif (redValue <= 170 and greenValue <= 210 and blueValue <= 200):
            if(mode == "auto"):
                self.arduino.write("stop\n".encode())
            color = "GREEN"
            
        elif (redValue <= 200 and greenValue <= 200 and blueValue >= 200):
            if(mode == "auto"):
                self.arduino.write("stop\n".encode())
            color = "BLUE"
            
        elif (redValue >= 200 and greenValue >= 200 and blueValue >= 200):
            color = "WHITE"
        else:
            color = "NO ACCEPTED COLOR"

        if(mode == "auto"):
            if color == "GREEN":
                self.lastcolor = "green"
                
                if(self.hasstarted):
                    print("FINISH LINE ERREICHT!")
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "POSITION": "end"})
                    self.arduino.write(("stop" + "\n").encode())
                    self.dataclass.steuerung_aut = False
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "manual"})
                    self.hasstarted = False 
                    self.delayed_function(1, "stop") 
                    return 0
                else:
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "POSITION": "start"})
                    self.arduino.write("stop\n".encode())
                    self.arduino.write(("forward" + "\n").encode())
                    time.sleep(0.8)
                    self.hasstarted = True
                    self.delayed_function(1, "drivemode=t")
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "POSITION": "field"})
            elif color == "RED":
                self.arduino.write("stop\n".encode())
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "CARD": "red"})
                self.lastcolor = "red"
                self.arduino.write("forward\n".encode())
                time.sleep(0.55)
                self.arduino.write("stop\n".encode())
                self.arduino.write("dropCard\n".encode())
                time.sleep(4)# waits drop
                t0 = self.getSensordatafromArduino("MOVING_CARD")
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD": t0})
                while(t0!= "none"):
                    t0 = self.getSensordatafromArduino("MOVING_CARD")
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD": t0})
                self.arduino.write(("drivemode=t" +"\n").encode())  # Send message
                time.sleep(0.45)
                
            elif color == "BLUE":
                self.arduino.write("stop\n".encode())
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "CARD": "blue"})
                self.lastcolor = "blue"
                self.arduino.write("forward\n".encode())
                time.sleep(0.2)
                self.arduino.write("stop\n".encode())
                self.arduino.write("pickupCard\n".encode())
                time.sleep(10)# waits drop
                t0 = self.getSensordatafromArduino("MOVING_CARD")
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD": t0})
                while(t0!= "none"):
                    t0 = self.getSensordatafromArduino("MOVING_CARD")
                send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "MOVING_CARD": t0})
                self.arduino.write(("drivemode=t" +"\n").encode())  # Send message
                time.sleep(0.45)
                        
            else:#no color or withe or yellow
                if self.lastcolor != "none":
                    self.lastcolor = "none"
                    if(color == "NO ACCEPTED COLOR"):#debug no color 
                        print("DEBUG: No accepted COLOR command from Arduino!")
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "CARD": "none"})
        else:#manual mode
            if color == "GREEN":
                if(self.lastcolor != "green"):  
                    self.lastcolor = "green"
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "STATUS": "READY"})
            else:
                if(self.lastcolor != "none"):
                    self.lastcolor = "none"
                    send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "CARD": "none"})
    def control_distance(self, distance):
        SAFE_DISTANZ = 230#Safe distanz
        values= []
        keys =[]
        data = ""
        """ Process distance sensor values """
        """left---forward----right"""
        distances = distance.split(",")
        distances = [int(num) for num in distances]
        print("dis ",distances)
        if (distances[1] < 80):
            print("DEBUG: Obstacle  front detected!")
            self.arduino.write(("stop" + "\n").encode())  # go backward
            self.arduino.write(("backward" + "\n").encode())
            time.sleep(0.5)
            self.arduino.write(("left" + "\n").encode())
            time.sleep(0.5)
            self.arduino.write(("stop" + "\n").encode())
        elif distances[0] < 50 or distances[2] < 50:
            print("DEBUG: Obstacle left or right detected!")
            self.arduino.write(("stop" + "\n").encode())  # go backward
            self.arduino.write(("backward" + "\n").encode())
            time.sleep(0.5)
            self.arduino.write(("stop" + "\n").encode())
            if distances[0] < 50:
                self.arduino.write(("right" + "\n").encode())
                time.sleep(0.2)
                self.arduino.write(("stop" + "\n").encode())
            else:
                self.arduino.write(("left" + "\n").encode())
                time.sleep(0.2)
                self.arduino.write(("stop" + "\n").encode())
            
        elif distances[0] > SAFE_DISTANZ:
            self.arduino.write(("forward" + "\n").encode())
            time.sleep(0.20)
            self.arduino.write(("left" + "\n").encode())
            time.sleep(0.1)
        elif distances[1] > (SAFE_DISTANZ):
            if (distances[0] - distances[2]  < 5 and distances[0] - distances[2]  > -5):
                self.arduino.write(("stop" + "\n").encode())
                self.arduino.write(("forward" + "\n").encode())
            else:
                if (distances[0] > SAFE_DISTANZ or distances[2] > SAFE_DISTANZ):
                    self.arduino.write(("forward" + "\n").encode())
                else:
                    if(distances[0] - distances[2]< 0):
                        self.arduino.write(("stop" + "\n").encode())
                        send_command = "right"  # go forward
                        self.arduino.write((send_command + "\n").encode())
                    else:
                        self.arduino.write(("stop" + "\n").encode())
                        send_command = "left"  # go forward
                        self.arduino.write((send_command + "\n").encode())
        elif distances[2] > SAFE_DISTANZ:
            self.arduino.write(("forward" + "\n").encode())
            time.sleep(0.15)
            self.arduino.write(("rightTurn" + "\n").encode())
            print("DEBUG: rightTurn")
            time.sleep(0.75)
            self.arduino.write(("stop" + "\n").encode())
        else:
            self.arduino.write(("stop" + "\n").encode())
            if(distances[0] - distances[2]> 0):
                send_command = "leftTurn"  # make a turn left
                print("Debug lTurn")
                self.arduino.write((send_command + "\n").encode())
                time.sleep(2.3)
            else:   
                self.arduino.write(("rightTurn" + "\n").encode()) # make a turn rigtht
                print("Debug rTurn")
                
                time.sleep(2.3)
            self.arduino.write(("stop" + "\n").encode())
        """walls = []
        if(distances[0]< SAFE_DISTANZ):
            keys.append("WALL")
            values.append("left")
            walls.append("left")
        if (distances[1] < SAFE_DISTANZ):
            keys.append("WALL")
            values.append("front")
            walls.append("front")
        if (distances[2] < SAFE_DISTANZ):
            walls.append("right")
        if(len(keys) <= 1):#controll if there is any wall
            walls.append("none")
       
        data = {
            "TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"),
            "WALL": walls
        }"""
        if(distances[0]< SAFE_DISTANZ):
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "left"})
        else:#controll if there is any wall
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "none"})
        if (distances[1] < SAFE_DISTANZ):
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "front"})
        else:#controll if there is any wall
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "none"})
        if (distances[2] < SAFE_DISTANZ):
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "right"})
        else:#controll if there is any wall
            send_json({"TIMESTAMP": datetime.now().strftime("%d/%m/%Y %H:%M:%S"), "WALL": "none"})

        
