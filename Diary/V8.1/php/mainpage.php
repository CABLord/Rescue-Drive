<?php 
require 'functions.php';
checkLogin(); 

$_SESSION['location'] = "mainpage.php";?>
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

<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="mainpage.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
    <div class="w3-right w3-hide-small">
      <a href="aboutus.php" class="w3-bar-item w3-button">Über uns</a>
      <a href="carinfo.php" class="w3-bar-item w3-button">Unser Produkt</a>
      <?php if($_SESSION["isLoggedIn"] == 1) : ?>
        <a href="entries.php" class="w3-bar-item w3-button">Tagebuch</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      <?php else : ?>
        <a href="login.php" class="w3-bar-item w3-button">Login</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="images/RTW_Weißes_Kreuz_Südtirol_(12-05-2018).jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>ResQ</b></span> <span class="w3-hide-small w3-text-light-grey">Drive</span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

<!-- Image of location/map -->
<div class="w3-container">
    <h3>Unser Standort</h3>
  <img src="images/map.PNG" class="w3-image" style="width:100%">
</div>

<!-- End page content -->
</div>

<!-- Footer einbinden -->
<?php include 'html/footer.html'; ?>

</body>
</html>
