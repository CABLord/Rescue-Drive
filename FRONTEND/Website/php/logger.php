<?php
require 'functions.php';
checkLogin();

$_SESSION['location'] = "index.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResQ Drive</title>
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/logger.css">
    <link rel="stylesheet" href="styles/entries.css">
    <link rel="stylesheet" href="styles/table.css">
    <link rel="stylesheet" href="styles/buttons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="jscript/logger.js"></script>
</head>

<body>
    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>ResQRover-Logs</h2>

    <div class="container mt-5">
        <div id="dashboard">
            <!-- Widgets und Panels werden hier eingefügt -->
        </div>

        <!-- Neuer Container für die Darstellung des aktuellen Log-Eintrags -->
        <div id="current-log-container" class="current-log-container">
            <div id="current-log">
                <!-- Hier wird der aktuelle Log-Eintrag angezeigt -->
            </div>
        </div>
    </div>

    <!-- Button zum Löschen der Logs -->
    <div class="add-entry-btn-container">
        <button class="button-common add-entry-btn" onclick="deleteLogs()">
            <i class="button-icon fas fa-trash" style="margin-right: 8px;"></i> Logs löschen
        </button>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="jscript/dashboard.js"></script>
</body>

</html>