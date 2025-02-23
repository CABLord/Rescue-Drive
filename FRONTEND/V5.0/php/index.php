<?php
require 'functions.php';
checkLogin();

$_SESSION['location'] = "index.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <title>ResQ Drive</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
  <link rel="stylesheet" href="styles/global.css">
</head>

<body>

  <!-- Menü einbinden -->
  <?php include 'html/menu.html'; ?>

  <!-- Header -->
  <header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
    <img class="w3-image" src="images/RTW_Weißes_Kreuz_Südtirol_(12-05-2018).jpg" alt="Architecture" width="1500" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
      <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>ResQ</b></span> <span class="w3-hide-small w3-text-light-grey">Drive</span></h1>
    </div>
  </header>

  <!-- Page content -->
  <div class="w3-content w3-padding" style="max-width:1564px">

    <!-- Google Maps Location -->
    <div class="w3-container">
      <h3>Unser Standort</h3>
      <iframe
        width="100%"
        height="450"
        style="border:0"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.9302218845046!2d11.646225076177869!3d46.72015447112227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4778050d856c4db1%3A0x6fb001a274b91114!2sOberschulen%20Jakob%20Philipp%20Fallmerayer!5e1!3m2!1sde!2sit!4v1740313961513!5m2!1sde!2sit"
        </iframe>
    </div>

    <!-- End page content -->
  </div>
  
  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>
  
</body>

</html>