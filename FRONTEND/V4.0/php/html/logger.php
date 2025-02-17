<?php 
require 'functions.php';
checkLogin(); 

$_SESSION['location'] = "index.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResQ Drive</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/control.css">
    <link rel="stylesheet" href="styles/logger.css"> <!-- Neue CSS-Datei für Logger -->
</head>
<body>

<!-- Menü einbinden -->
<?php include 'html/menu.html'; ?>

<h2>Steuerung</h2>
<div id="content-area">
    <!-- Hier werden die Pfeile platziert -->
    <div class="arrow up"></div>
    <div class="arrow left"></div>
    <div class="arrow down"></div>
    <div class="arrow right"></div>
</div>

<h2>Arduino Logger</h2>
<div class="logger" id="logger">
    <div class="status" id="status">Fetching data...</div>
</div>

<!-- Footer einbinden -->
<?php include 'html/footer.html'; ?>

<script src="jscript/script.js"></script>
<script src="jscript/logger.js"></script> <!-- Neue JavaScript-Datei für Logger -->
</body>
</html>
