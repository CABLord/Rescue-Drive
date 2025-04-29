#include "Adafruit_VL53L0X.h"
#include <Wire.h>
#include <Stepper.h>
#include <Servo.h>

//Servo
Servo myservo;
int pos = 120;

// VL53L0X Sensors
Adafruit_VL53L0X lox1 = Adafruit_VL53L0X();
Adafruit_VL53L0X lox2 = Adafruit_VL53L0X();
Adafruit_VL53L0X lox3 = Adafruit_VL53L0X();
#define PCAADDR 0x70

bool drivemode = true; // Color Scan loop

// Color Sensor Pins
#define S0 23
#define S1 25
#define S2 27
#define S3 29
#define sensorOut 31

// Motor driver Pins
#define rightMotorPin1 2
#define rightMotorPin2 3
#define leftMotorPin1 4
#define leftMotorPin2 5
#define ENA 6
#define ENB 7
int speedA = 200;// 182
int speedB = 200;

// LDR and Potentiometer
#define ldrPin A2
#define potPin A1
#define ledPin 22


// Calibration Values for Color Sensor
int redMin = 18, redMax = 150;
int greenMin = 18, greenMax = 150;
int blueMin = 18, blueMax = 150;

// Stepper Motor Configuration
const int stepsPerRevolution = 2038;
Stepper dropStepper(stepsPerRevolution, 8, 10, 9, 11);
Stepper pickupStepper(stepsPerRevolution, 17, 15, 16, 14);

//7seg & battery
const int numbers[10] = {
  0b0001000, //0
  0b1111001, //1
  0b0100100, //2
  0b0110000, //3
  0b1010001, //4
  0b0010010, //5
  0b0000010, //6
  0b1111000, //7
  0b0000000, //8
  0b0010000  //9
};

float adc_voltage = 0.0;
float in_voltage = 0.0;
float R1 = 30000.0;
float R2 = 7500.0;
float ref_voltage = 5.0;
int adc_max = 1023;
float battery_full = 9.0;
float battery_empty = 6.0; 
int adc_value;
int num;


void pcaSelect(uint8_t i) {
    if (i > 7) return;
    Wire.beginTransmission(PCAADDR);
    Wire.write(1 << i);
    Wire.endTransmission();
}

String input = "";

void setup() {
    Serial.begin(9600);
    Wire.begin();

    pinMode(ledPin, OUTPUT);

    // Color Sensor Pins
    pinMode(S0, OUTPUT);
    pinMode(S1, OUTPUT);
    pinMode(S2, OUTPUT);
    pinMode(S3, OUTPUT);
    pinMode(sensorOut, INPUT);
    digitalWrite(S0, HIGH);
    digitalWrite(S1, LOW);

    // Motor Speed
    analogWrite(ENA, speedA);
    analogWrite(ENB, speedB);

    //Servo Pin
    
    myservo.attach(19);
    
    myservo.write(pos);
    //PICKUPSTEPPER
    pinMode(14, OUTPUT);
    pinMode(15, OUTPUT);
    pinMode(16, OUTPUT);
    pinMode(17, OUTPUT);
    //drop Servo
    pinMode(8, OUTPUT);
    pinMode(9, OUTPUT);
    pinMode(10, OUTPUT);
    pinMode(11, OUTPUT);
/*
    //7seg Pins
    pinMode(A0, INPUT);
    pinMode(40, OUTPUT); //rot
    pinMode(41, OUTPUT); //grau
    pinMode(42, OUTPUT); //braun
    pinMode(43, OUTPUT); //violet bei widerstand

    pinMode(44, OUTPUT); //violet
    pinMode(45, OUTPUT); //gelb oben
    pinMode(46, OUTPUT); //weiss
    pinMode(47, OUTPUT); //schwart
    pinMode(48, OUTPUT); //grÃ¼n
    pinMode(49, OUTPUT); //orange
    pinMode(50, OUTPUT); //gelb unten
  */
    // Distance Sensor Initialization
    pcaSelect(0);
    if (!lox1.begin()) {
        Serial.println(F("Failed to boot VL53L0X on channel 0"));
        while (1);
    }
    pcaSelect(1);
    if (!lox2.begin()) {
        Serial.println(F("Failed to boot VL53L0X on channel 1"));
        while (1);
    }
    pcaSelect(2);
    if (!lox3.begin()) {
        Serial.println(F("Failed to boot VL53L0X on channel 2"));
        while (1);
    }
    //digitalWrite(22,HIGH);
    //pickupStepper.setSpeed(10);
    //pickupStepper.step(-stepsPerRevolution * 1.5/4);
    Serial.println("Sensors initialized successfully!");
}

void loop() {
    if (Serial.available() > 0) {
        input = Serial.readStringUntil('\n'); 
        input.trim();
        processCommand(input);
    }
    if (drivemode) {
        readminicolor();
        
    }
/*
   for(int i = 43; i > 39; i--){
    digitalWrite(i, HIGH);
    int dig = num%10;
    num = num/10;
    displayNumber(dig);
    delay(5);
    digitalWrite(i, LOW);
  }*/
}

void processCommand(String input) {
    if (input == "forward") forward();
    else if (input == "left") left();
    else if (input == "right") right();
    else if (input == "backward") back();
    else if (input == "leftTurn") leftTurn(); 
    else if (input == "rightTurn") rightTurn(); 
    else if (input == "readLaser") readLaser(); 
    else if (input == "readColor") readColor(); 
    else if (input == "readLight") readLight(); 
    else if (input == "pickupCard") pickupCard();
    else if (input == "dropCard") dropCard(); 
    else if (input == "stop") stopMotors(); 
    else if (input == "readBattery") readBattery();
    else if (input == "drivemode=t") {
        drivemode = true; 
    }
    else Serial.println("Unknown command");
}

void readLaser() {
    VL53L0X_RangingMeasurementData_t measure;
    
    pcaSelect(0);
    lox1.rangingTest(&measure, false);
    Serial.print("DISTANCE:");
    Serial.print(measure.RangeStatus != 4 && measure.RangeMilliMeter != 8191 ? measure.RangeMilliMeter : 9999);

    pcaSelect(1);
    lox2.rangingTest(&measure, false);
    Serial.print(",");
    Serial.print(measure.RangeStatus != 4 && measure.RangeMilliMeter != 8191 ? measure.RangeMilliMeter : 9999);

    pcaSelect(2);
    lox3.rangingTest(&measure, false);
    Serial.print(",");
    Serial.println(measure.RangeStatus != 4 && measure.RangeMilliMeter != 8191 ? measure.RangeMilliMeter : 9999);
}

void readColor() {
    int redValue = map(getColorPW(LOW, LOW), redMin, redMax, 255, 0);
    int greenValue = map(getColorPW(HIGH, HIGH), greenMin, greenMax, 255, 0);
    int blueValue = map(getColorPW(LOW, HIGH), blueMin, blueMax, 255, 0);

    Serial.print("COLOR:");
    Serial.print(redValue);
    Serial.print(",");
    Serial.print(greenValue);
    Serial.print(",");
    Serial.println(blueValue);
}

int getColorPW(bool s2, bool s3) {
    digitalWrite(S2, s2);
    digitalWrite(S3, s3);
    return pulseIn(sensorOut, LOW);
}

void readLight() {
    int lightValue = analogRead(ldrPin);
    int threshold = analogRead(potPin);

    if (lightValue > threshold) {
        digitalWrite(ledPin, HIGH); 
        Serial.println("BRIGHTNESS:dark");
        Serial.println("LIGHT:ON");
    } else {
        digitalWrite(ledPin, LOW);
        Serial.println("BRIGHTNESS:bright");
        Serial.println("LIGHT:OFF");
    }
}

void dropCard() {
    Serial.println("MOVING_CARD:discard");  
    dropStepper.setSpeed(10);
    dropStepper.step(-stepsPerRevolution / 1.7);
    delay(1000);
    dropStepper.setSpeed(10);
    dropStepper.step(stepsPerRevolution / 1.7);
    delay(1000);
    digitalWrite(8, LOW);
    digitalWrite(9, LOW);
    digitalWrite(10, LOW);
    digitalWrite(11, LOW);

    Serial.println("MOVING_CARD:none");
}

void pickupCard() {
    Serial.println("MOVING_CARD:pick up");   
    pickupStepper.setSpeed(10);
    pickupStepper.step(stepsPerRevolution * 1.55);
    delay(1000);  
    pickupStepper.setSpeed(10);
    pickupStepper.step(-stepsPerRevolution * 1.55);
    delay(1000);
    digitalWrite(14, LOW);
    digitalWrite(15, LOW);
    digitalWrite(16, LOW);
    digitalWrite(17, LOW);
    servoTurn(); 
    Serial.println("MOVING_CARD:none");
}

void servoTurn(){
  
  for(int i=pos; i>pos-120;i-=1){
    myservo.write(i);
    delay(15);
  }
  for(int j=pos-120; j<pos;j+=1){
    myservo.write(j);
    delay(15);
  }
}

void forward() {
    Serial.println("DRIVE:forward");
    digitalWrite(rightMotorPin1, LOW);
    digitalWrite(rightMotorPin2, HIGH);
    digitalWrite(leftMotorPin1, LOW);
    digitalWrite(leftMotorPin2, HIGH);
}

void back() {
    Serial.println("DRIVE:backward");
    digitalWrite(rightMotorPin1, HIGH);
    digitalWrite(rightMotorPin2, LOW);
    digitalWrite(leftMotorPin1, HIGH);
    digitalWrite(leftMotorPin2, LOW);
}

void stopMotors() {
    Serial.println("DRIVE:stop");
    digitalWrite(rightMotorPin1, LOW);
    digitalWrite(rightMotorPin2, LOW);
    digitalWrite(leftMotorPin1, LOW);
    digitalWrite(leftMotorPin2, LOW);
}

void left() {
    Serial.println("DRIVE:left");
    digitalWrite(rightMotorPin1, LOW);
    digitalWrite(rightMotorPin2, HIGH);
    digitalWrite(leftMotorPin1, LOW);
    digitalWrite(leftMotorPin2, LOW);
}

void right() {
    Serial.println("DRIVE:right");
    digitalWrite(rightMotorPin1, LOW);
    digitalWrite(rightMotorPin2, LOW);
    digitalWrite(leftMotorPin1, LOW);
    digitalWrite(leftMotorPin2, HIGH);
}

void leftTurn() {
    Serial.println("DRIVE:left");
    digitalWrite(rightMotorPin1, LOW);
    digitalWrite(rightMotorPin2, HIGH);
    digitalWrite(leftMotorPin1, HIGH);
    digitalWrite(leftMotorPin2, LOW);
}

void rightTurn() {
    Serial.println("DRIVE:right");
    digitalWrite(rightMotorPin1, HIGH);
    digitalWrite(rightMotorPin2, LOW);
    digitalWrite(leftMotorPin1, LOW);
    digitalWrite(leftMotorPin2, HIGH);
}


void readminicolor() {
    if (!(map(getColorPW(LOW, LOW), redMin, redMax, 255, 0) >= 200 &&
          map(getColorPW(HIGH, HIGH), greenMin, greenMax, 255, 0) >= 200 &&
          map(getColorPW(LOW, HIGH), blueMin, blueMax, 255, 0) >= 200)) {
        stopMotors();
        drivemode = false;
    }
}

void readBattery(){
  adc_value = analogRead(A0);
  adc_voltage = (adc_value * ref_voltage) / adc_max;
  in_voltage = adc_voltage * ((R1 + R2) / R2);
  float battery_percentage = ((in_voltage - battery_empty) / (battery_full - battery_empty)) * 100.0;
  battery_percentage = constrain(battery_percentage, 0, 100);
  Serial.print("AKKU:");
  Serial.println(battery_percentage, 1);
  num = battery_percentage;
}
/*void displayNumber(int x){
  int num = numbers[x];
  for(int i = 50; i > 43; i--){
    int mode = (num >> (i - 6)) & 1;
    digitalWrite(i, mode);
  }
}*/
