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

  <?php include 'html/components.html'; ?>

  <h2 style="text-align: center;">Mechanismen</h2>

  <!-- 3D STL Modell -->
  <h2 style="text-align: center;">3D Bauteil-Ansicht</h2>
  <div id="stl-container" style="width: 100%; height: 500px;"></div>

  <!-- Footer einbinden -->
  <?php include 'html/footer.html'; ?>

  <script src="https://cdn.skypack.dev/three"></script>
  <script src="https://cdn.skypack.dev/three/examples/jsm/loaders/STLLoader.js"></script>
  
  <script type="module" src="jscript/model1.js"></script>
  <script src="jscript/carinfo.js"></script>
</body>

</html>
