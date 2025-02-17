<?php
require 'functions.php';
checkLogin();

$_SESSION['location'] = "carinfo.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ResQ Drive</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/carinfo.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
</head>

<body>

  <!-- W3 Top Bar --><!-- Menü einbinden -->
  <?php include 'html/menu.html'; ?>

  <!-- Page content -->
  <div class="w3-content w3-padding" style="max-width:1564px"></div>
  <div class="content"></div>

  <!-- End page content -->
  </div>

  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>
</body>

</html>