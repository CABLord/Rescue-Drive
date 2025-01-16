void setup() {
  // put your setup code here, to run once:
   Serial.begin(9600); // Serielle Kommunikation starten
   Serial.println("Arduino bereit!"); // Begrüßungsnachricht
   pinMode(8,HIGH);
   pinMode(9,HIGH);
}

void loop() {
  // put your main code here, to run repeatedly:
  if (Serial.available() > 0) { // Prüfen, ob Daten empfangen wurden
    String input = Serial.readStringUntil('\n'); // Nachricht lesen
    input.trim(); // Leerzeichen entfernen
    Serial.print("Empfangen: "); 
    Serial.println(input); // Nachricht zurückschicken
    if (input == "W") {
      Serial.println("Beide Motoren fahren"); // Antwort auf PING senden
      digitalWrite(9,HIGH);
      digitalWrite(8,HIGH);
    } else if(input == "A") {
      Serial.println("linker Motor fährt");
      digitalWrite(9,HIGH);
      digitalWrite(8,LOW);
    }
    else if(input == "D") {
      Serial.println("rechter Motor fährt");
      digitalWrite(9,LOW);
      digitalWrite(8,HIGH);
    }else if(input == "S") {
      Serial.println("Beide Motoren fahren rückwährts");
      digitalWrite(9,HIGH);
      digitalWrite(8,HIGH);
    }
    else if(input == "STOP") {
      Serial.println("Motoren Stopen!");
      digitalWrite(9,LOW);
      digitalWrite(8,LOW);
    }else {
      Serial.println("kein korrekter Befehl");
    }
  }
}
