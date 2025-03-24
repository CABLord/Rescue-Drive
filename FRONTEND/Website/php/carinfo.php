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

  <div id="bauteile-header" style="margin-top: 80px;">
    <h2 id="toggle-button">
      <span>🔧</span> Bauteile ▼
    </h2>
    <p id="bauteile-description">Hier kannst du alle Bauteile des Fahrzeugs einsehen. Klicke auf die Überschrift, um die Liste anzuzeigen.</p>
  </div>


  <div id="bauteile-container" class="container">
    <div class="tile">
      <img src="raspberrypi.jpg" alt="Raspberry Pi">
      <div>
        <h2>Raspberry Pi 5</h2>
        <p>Der Mini-Computer steuert das gesamte System und verarbeitet Sensordaten sowie Steuerbefehle.</p>
      </div>
    </div>

    <div class="tile">
      <img src="arduino.jpg" alt="Arduino">
      <div>
        <h2>Arduino</h2>
        <p>Ein Mikrocontroller zur Steuerung verschiedener Bauteile, insbesondere der Sensoren und Motoren.</p>
      </div>
    </div>

    <div class="tile">
      <img src="lasersensor.jpg" alt="Laserdistanzsensor">
      <div>
        <h2>Laserdistanzsensor</h2>
        <p>Misst Abstände bis zu 2 Metern und wird zur Hinderniserkennung oder Abstandsmessung genutzt.</p>
      </div>
    </div>

    <div class="tile">
      <img src="kupferkabel.jpg" alt="Kupferkabel">
      <div>
        <h2>Kupferkabel</h2>
        <p>Dient zur elektrischen Verbindung zwischen den Komponenten, ermöglicht Signalübertragung und Stromversorgung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="raeder.jpg" alt="Räder">
      <div>
        <h2>Räder</h2>
        <p>Sorgen für die Fortbewegung des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="dc_motor.jpg" alt="Motor">
      <div>
        <h2>Motor (DC 12V-36V)</h2>
        <p>Treibt die Räder an und sorgt für die Bewegung des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="steppermotor.jpg" alt="Stepper Motor">
      <div>
        <h2>Stepper Motor</h2>
        <p>Präzise steuerbare Motoren für Aufgaben wie das Heben und Senken des Elektromagneten sowie den Kärtchentransport.</p>
      </div>
    </div>

    <div class="tile">
      <img src="elektromagnet.jpg" alt="Elektromagnet">
      <div>
        <h2>Elektromagnet</h2>
        <p>Hebt magnetische Kärtchen an, indem er durch einen Stepper-Motor bewegt wird.</p>
      </div>
    </div>

    <div class="tile">
      <img src="steckbrett.jpg" alt="Steckbrett">
      <div>
        <h2>Steckbrett & Kabel</h2>
        <p>Dient zum einfachen Aufbau und Testen der elektrischen Schaltung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="karosserie.jpg" alt="Karosserie">
      <div>
        <h2>Karosserie (3D Druck)</h2>
        <p>Das Gehäuse des Fahrzeugs, das alle Komponenten schützt und strukturiert hält.</p>
      </div>
    </div>

    <div class="tile">
      <img src="farbsensor.jpg" alt="Farbsensor">
      <div>
        <h2>Farbsensor</h2>
        <p>Erkennt Farben, möglicherweise zur Unterscheidung von Kärtchen oder zur Orientierung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="lenkrollen.jpg" alt="Lenkrollen">
      <div>
        <h2>Lenkrollen</h2>
        <p>Unterstützen die Stabilität und Beweglichkeit des Fahrzeugs.</p>
      </div>
    </div>

    <div class="tile">
      <img src="schienenraeder.jpg" alt="Schienenräder">
      <div>
        <h2>Schienenräder</h2>
        <p>Spezielle Räder für Schienensysteme, möglicherweise für eine zusätzliche Führung.</p>
      </div>
    </div>

    <div class="tile">
      <img src="schiene.jpg" alt="Schiene">
      <div>
        <h2>Schiene</h2>
        <p>Führt oder begrenzt bestimmte Bewegungen, z. B. für den Kärtchenauswurf.</p>
      </div>
    </div>

    <div class="tile">
      <img src="kugellager.jpg" alt="Kugellager-Rad">
      <div>
        <h2>Kugellager-Rad</h2>
        <p>Reduziert Reibung und erleichtert Drehbewegungen.</p>
      </div>
    </div>

    <div class="tile">
      <img src="batterie.jpg" alt="Batterie Mikrocontroller">
      <div>
        <h2>Batterie für Mikrocontroller (7,4 V)</h2>
        <p>Versorgt den Mikrocontroller mit Energie.</p>
      </div>
    </div>

    <div class="tile">
      <img src="batterie_motor.jpg" alt="Batterie Motoren">
      <div>
        <h2>Batterie für Motoren (-12 V)</h2>
        <p>Liefert Strom für die Motoren.</p>
      </div>
    </div>

    <div class="tile">
      <img src="loetplatine.jpg" alt="Lötplatine">
      <div>
        <h2>Lötplatine</h2>
        <p>Ermöglicht eine feste Verdrahtung und Montage elektrischer Komponenten.</p>
      </div>
    </div>
  </div>

  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>

  <script src="jscript/carinfo.js"></script>
</body>

</html>