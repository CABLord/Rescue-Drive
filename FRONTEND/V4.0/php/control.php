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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/control.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>Steuerung</h2>

    <div class="container">
        <div class="control-message" id="message">
            Use the arrow keys (↑←↓→) or WASD to control the vehicle
        </div>
    </div>

    <div class="controls-container">
        <!-- Steuerung-Buttons -->
        <button class="control-btn btn-up" onmousedown="controlCar('forward')" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="controlCar('forward')" ontouchend="stopCar()">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button class="control-btn btn-left" onmousedown="controlCar('left')" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="controlCar('left')" ontouchend="stopCar()">
            <i class="fas fa-arrow-left"></i>
        </button>
        <button class="control-btn btn-right" onmousedown="controlCar('right')" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="controlCar('right')" ontouchend="stopCar()">
            <i class="fas fa-arrow-right"></i>
        </button>
        <button class="control-btn btn-down" onmousedown="controlCar('backward')" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="controlCar('backward')" ontouchend="stopCar()">
            <i class="fas fa-arrow-down"></i>
        </button>

        <!-- Magnet-Buttons -->
        <button class="control-btn btn-magnet-up" onmousedown="activateMagnetUp()" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="activateMagnetUp()" ontouchend="stopCar()">
            <i class="fas fa-magnet"></i> <i class="fas fa-arrow-up"></i>
        </button>

        <button class="control-btn btn-magnet-down" onmousedown="activateMagnetDown()" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="activateMagnetDown()" ontouchend="stopCar()">
            <i class="fas fa-magnet"></i> <i class="fas fa-arrow-down"></i>
        </button>

        <!-- Hilfspacket-Button -->
        <button class="control-btn btn-drop" onmousedown="dropPackage('drop')" onmouseup="stopCar()"
            onmouseleave="stopCar()" ontouchstart="controlCar('drop')" ontouchend="stopCar()">
            <i class="fas fa-first-aid"></i> <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="jscript/control.js"></script>
</body>

</html>