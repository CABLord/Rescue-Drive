#include <Stepper.h>

// definizione del numero di passi per rotazione
const int stepsPerRevolution = 2048;

// creazione dell'istanza della classe stepper

/*
 * IN1 -> 8
 * IN2 -> 9
 * IN3 -> 10
 * IN4 -> 11
 */

Stepper myStepper(stepsPerRevolution, 8, 10, 9, 11);

void setup() {
  /* 
   * non è necessario impostare i pin di Arduino
   * a cui collegare la scheda dello stepper 
   * vengono gestiti dalla libreria
   */

// imposta la velocità a 15 rpm:
  myStepper.setSpeed(15);

// inizializzazione della porta seriale
  Serial.begin(9600);
}

void loop() {
  // imposta una rotazione in senso orario
  Serial.println("orario");
  myStepper.step(stepsPerRevolution);
  delay(500);

// imposta una rotazione in senso antiorario
  Serial.println("antiorario");
  myStepper.step(-stepsPerRevolution);
  delay(500);
}
