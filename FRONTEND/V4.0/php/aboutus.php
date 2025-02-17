<?php

require 'functions.php';
checkLogin();

$_SESSION['location'] = "aboutus.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ResQ Drive</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
</head>

<body>
  <!-- Menü einbinden -->
  <?php include 'html/menu.html'; ?>

  <!-- Page content -->
  <div class="w3-content w3-padding" style="max-width:1564px">

    <!-- About Section -->
    <div class="w3-container w3-padding-32" id="about">
      <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
      <p>Wir sind eine Gruppe aus Maturanten, die einen Rettungswagen bauen.</p>
    </div>

    <div class="w3-row-padding">
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Fabian" style="width:100%">
        <h3>Fabian Leimegger</h3>
        <p class="w3-opacity">Projektleiter</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Lorik" style="width:100%">
        <h3>Lorik Bajgora</h3>
        <p class="w3-opacity">Architect</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Ivan" style="width:100%">
        <h3>Ivan Federspieler</h3>
        <p class="w3-opacity">Architect</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Felix" style="width:100%">
        <h3>Felix Hinteregger</h3>
        <p class="w3-opacity">Architect</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Alex" style="width:100%">
        <h3>Alex Guarino</h3>
        <p class="w3-opacity">Architect</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <img src="images/man.jpg" alt="Florian" style="width:100%">
        <h3>Florian Firler</h3>
        <p class="w3-opacity">Architect</p>
        <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
        <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
      </div>
    </div>

    <!-- End page content -->
  </div>

  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>

</body>

</html>