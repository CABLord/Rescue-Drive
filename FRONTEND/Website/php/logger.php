<?php
require 'functions.php';
checkLogin();

$_SESSION['location'] = "index.php";
?>

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
    <link rel="stylesheet" href="styles/entries.css">
    <link rel="stylesheet" href="styles/table.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logger</title>
    </head>

    <body>

        <h2>Auto Statusanzeige</h2>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Wall</th>
                    <th>Card</th>
                    <th>Position</th>
                    <th>Brightness</th>
                    <th>Moving Card</th>
                    <th>Drive</th>
                    <th>Light</th>
                    <th>Akku</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="data-body">
                <!-- Daten werden hier eingefügt -->
            </tbody>
        </table>

    </body>

    </html>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="logger.js"></script>
</html>
</body>

</html>