<?php
require 'functions.php';
checkLogin();

$_SESSION['location'] = "carinfo.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bauteile Übersicht</title>
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/carinfo.css">
</head>

<body>

  <!-- Menü einbinden -->
  <?php include 'html/menu.html'; ?>

  <h1 style="margin-top: 80px; text-align: center;">ResQRover</h1>
  <img src="resqrover.jpg" alt="ResQRover">

  <h2 style="margin-top: 80px; text-align: center;">Bauteile Übersicht</h2>

  <div id="bauteile-header" style="margin-top: 20px;">
    <h2 id="toggle-button">
      <span>🔧</span> Bauteile ▼
    </h2>
    <p id="bauteile-description">Hier kannst du alle Bauteile des Fahrzeugs einsehen. Klicke auf die Überschrift, um die Liste anzuzeigen.</p>
  </div>

  <div id="bauteile-container" class="container">
    <div class="tile">
      <img src="images/components/raspberrypi.jpg" alt="Raspberry Pi">
      <div>
        <h2>Raspberry Pi 5</h2>
        <p>Der Mini-Computer steuert das gesamte System und verarbeitet Sensordaten sowie Steuerbefehle.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/arduino.jpg" alt="Arduino">
      <div>
        <h2>Arduino</h2>
        <p>Ein Mikrocontroller zur Steuerung verschiedener Bauteile, insbesondere der Sensoren und Motoren.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/lasersensor.jpg" alt="Laserdistanzsensor">
      <div>
        <h2>Laserdistanzsensor</h2>
        <p>Misst Abstände bis zu 2 Metern und wird zur Hinderniserkennung oder Abstandsmessung genutzt.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/kupferkabel.jpg" alt="Kupferkabel">
      <div>
        <h2>Kupferkabel</h2>
        <p>Dient zur elektrischen Verbindung zwischen den Komponenten, ermöglicht Signalübertragung und Stromversorgung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/raeder.jpg" alt="Räder">
      <div>
        <h2>Räder</h2>
        <p>Sorgen für die Fortbewegung des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/dc_motor.jpg" alt="Motor">
      <div>
        <h2>Motor (DC 12V-36V)</h2>
        <p>Treibt die Räder an und sorgt für die Bewegung des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/steppermotor.jpg" alt="Stepper Motor">
      <div>
        <h2>Stepper Motor</h2>
        <p>Präzise steuerbare Motoren für Aufgaben wie das Heben und Senken des Elektromagneten sowie den Kärtchentransport.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/elektromagnet.jpg" alt="Elektromagnet">
      <div>
        <h2>Elektromagnet</h2>
        <p>Hebt magnetische Kärtchen an, indem er durch einen Stepper-Motor bewegt wird.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/steckbrett.jpg" alt="Steckbrett">
      <div>
        <h2>Steckbrett</h2>
        <p>Dient zum einfachen Aufbau und Testen der elektrischen Schaltung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/karosserie.jpg" alt="Karosserie">
      <div>
        <h2>Karosserie (Holz)</h2>
        <p>Das Gehäuse des Fahrzeugs, das alle Komponenten schützt und strukturiert hält.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/farbsensor.jpg" alt="Farbsensor">
      <div>
        <h2>Farbsensor</h2>
        <p>Erkennt Farben, möglicherweise zur Unterscheidung von Kärtchen oder zur Orientierung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/lenkrollen.jpg" alt="Lenkrollen">
      <div>
        <h2>Kugelrollen</h2>
        <p>Unterstützen die Stabilität und Beweglichkeit des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/batterie.jpg" alt="Batterie Mikrocontroller">
      <div>
        <h2>Batterie für Mikrocontroller (7,4 V)</h2>
        <p>Versorgt den Mikrocontroller mit Energie.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/powerbank.jpg" alt="Batterie Motoren">
      <div>
        <h2>Powerbank</h2>
        <p>Liefert Strom für den Raspberry.</p>
      </div>
    </div>

    <div class="tile">
      <img src="images/components/loetplatine.jpg" alt="Lötplatine">
      <div>
        <h2>Lötplatine</h2>
        <p>Ermöglicht eine feste Verdrahtung und Montage elektrischer Komponenten.</p>
      </div>
    </div>
  </div>

  <h2 style="text-align: center;">Mechanismen</h2>

  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>

  <script src="jscript/carinfo.js"></script>
</body>

</html>