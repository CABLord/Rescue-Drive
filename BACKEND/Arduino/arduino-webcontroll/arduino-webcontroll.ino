int motor1pin1 = 2;
int motor1pin2 = 3;

int motor2pin1 = 4;
int   motor2pin2 = 5;

void setup() {
  // put your setup code here, to run once:
   Serial.begin(9600); // Serielle Kommunikation starten
   Serial.println("Arduino bereit!"); // Begrüßungsnachricht
   // put your setup code here, to run once:
   pinMode(motor1pin1, OUTPUT);
    pinMode(motor1pin2, OUTPUT);
    pinMode(motor2pin1,   OUTPUT);
    pinMode(motor2pin2, OUTPUT);
  
    //(Optional)
    pinMode(9,   OUTPUT); 
    pinMode(10, OUTPUT);
    //(Optional)

}

void loop() {
  // put your main code here, to run repeatedly:
  if (Serial.available() > 0) { // Prüfen, ob Daten empfangen wurden
    String input = Serial.readStringUntil('\n'); // Nachricht lesen
    input.trim(); // Leerzeichen entfernen
    if (input == "forward") {
      Serial.println("Beide Motoren fahren"); // Antwort auf PING senden
      digitalWrite(motor1pin1,   HIGH);//Motor1 ->
      digitalWrite(motor1pin2, LOW);
      digitalWrite(motor2pin1, HIGH);//Motor2 ->
      digitalWrite(motor2pin2, LOW);

      analogWrite(9, 255); //Run Motor 1
      analogWrite(10, 255); //Run Motor 2

    } else if(input == "left") {
      Serial.println("linker Motor fährt");
      digitalWrite(motor1pin1,   HIGH);//Motor1 ->
      digitalWrite(motor1pin2, LOW);
      digitalWrite(motor2pin1, HIGH);//Motor2 ->
      digitalWrite(motor2pin2, LOW);
      analogWrite(9, 0); //Run Motor 1
      analogWrite(10, 255); //Run Motor 2

    }
    else if(input == "right") {
      Serial.println("rechter Motor fährt");
      digitalWrite(motor1pin1,   HIGH);//Motor1 ->
      digitalWrite(motor1pin2, LOW);
      digitalWrite(motor2pin1, HIGH);//Motor2 ->
      digitalWrite(motor2pin2, LOW);
      
      analogWrite(9, 255); //Run Motor 1
      analogWrite(10, 0); //Run Motor 2

    }else if(input == "backward") {
      Serial.println("Beide Motoren fahren rückwährts");
      digitalWrite(motor1pin1,   LOW);//Motor1 ->
      digitalWrite(motor1pin2, HIGH);
      digitalWrite(motor2pin1, LOW);//Motor2 ->
      digitalWrite(motor2pin2, HIGH);
      analogWrite(9, 255); //Run Motor 1
      analogWrite(10, 255); //Run Motor 2
    }
    else if(input == "stop") {
      Serial.println("Motoren Stopen!");
      analogWrite(9, 0); //stop Motor 1
      analogWrite(10, 0); //stop Motor 2
    }else {
      Serial.println("kein korrekter Befehl");
    }
  }
}
