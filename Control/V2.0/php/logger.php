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
    <link rel="stylesheet" href="styles/logger.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>Arduino Logger</h2>
    <div class="logger" id="logger">
        <div class="status" id="status">Fetching data...</div>
    </div>
    <script src="logger.js"></script>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>
</body>

</html>