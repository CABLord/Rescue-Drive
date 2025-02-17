<?php session_start(); 
if($_SESSION['isLoggedIn'] != 1) :
  $_SESSION['isLoggedIn'] = 0;
endif;
$_SESSION['location'] = "aboutus.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ResQ Drive</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="mainpage.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
    <div class="w3-right w3-hide-small">
      <a href="aboutus.php" class="w3-bar-item w3-button">Über uns</a>
      <a href="carinfo.php" class="w3-bar-item w3-button">Unser Pordukt</a>
      <?php if($_SESSION["isLoggedIn"] == 1) : ?>
        <a href="entries.php" class="w3-bar-item w3-button">Tagebuch</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      <?php else : ?>
        <a href="login.php" class="w3-bar-item w3-button">Login</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
    <p>Wir sind ein Gruppe aus Maturanten die einen Rettungswaagen bauen</p>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="man.jpg" alt="Fabian" style="width:100%">
      <h3>Fabian Leimegger</h3>
      <p class="w3-opacity">Projektleiter</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="man.jpg" alt="Lorik" style="width:100%">
      <h3>Lorik Bajgora</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="man.jpg" alt="Ivan" style="width:100%">
      <h3>Ivan Federspieler</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="houdini.png.png" alt="Felix" style="width:100%">
      <h3>Felix Hinteregger</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="man.jpg" alt="Alex" style="width:100%">
      <h3>Alex Guarino</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="man.jpg" alt="Florian" style="width:100%">
      <h3>Florian Firler</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
  </div>
  

<!-- End page content -->
</div>

<!-- Footer einbinden --> 
<?php include 'footer.html'; ?>

</body>
</html>