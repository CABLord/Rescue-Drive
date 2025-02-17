<?php session_start();
if($_SESSION['isLoggedIn'] != 1) :
  $_SESSION['isLoggedIn'] = 0;
endif;
$_SESSION['location'] = "carinfo.php";?>
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
<div class="w3-content w3-padding" style="max-width:1564px"></div>

<!-- End page content -->
</div>

<!-- Footer einbinden --> 
<?php include 'footer.html'; ?>

</body>
</html>