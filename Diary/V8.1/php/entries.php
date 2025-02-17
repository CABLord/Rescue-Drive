<?php
require 'fetch_entries.php';
require 'functions.php';

checkLogin();

$_SESSION['location'] = "mainpage.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Tagebuch</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/buttons.css">
    <link rel="stylesheet" href="styles/table.css">
    <link rel="stylesheet" href="styles/entries.css">
    <!-- Font Awesome CDN für die Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <script src="jscript/script.js" defer></script>
</head>

<body>
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="mainpage.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
            <div class="w3-right w3-hide-small">
                <a href="aboutus.php" class="w3-bar-item w3-button">Über uns</a>
                <a href="carinfo.php" class="w3-bar-item w3-button">Unser Produkt</a>
                <?php if ($_SESSION["isLoggedIn"] == 1) : ?>
                    <a href="entries.php" class="w3-bar-item w3-button">Tagebuch</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="w3-bar-item w3-button">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <h2>Tagebucheinträge</h2>
    <table>
        <tr>
            <th>Eingetragen von</th>
            <th>Betroffener</th>
            <th>Titel</th>
            <th>Datum</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= htmlspecialchars($entry['uploader']); ?></td>
                <td><?= htmlspecialchars($entry['coworker']); ?></td>
                <td>
                    <?= htmlspecialchars($entry['title']); ?>
                    <!-- Beschreibung-Button -->
                    <a href="description.php?entry_id=<?= htmlspecialchars($entry['entry_id']); ?>" class="button-common description-btn">
                        <i class="button-icon fas fa-file-alt"></i>
                    </a>
                </td>
                <td><?= htmlspecialchars(formatDate($entry['date'])); ?></td>
                <td>
                    <!-- Bearbeiten-Button mit Stiftsymbol -->
                    <form method="GET" action="edit_entry.php" style="display:inline;">
                        <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                        <button type="submit" name="edit_entry" class="button-common edit-btn">
                            <i class="button-icon fas fa-edit"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <!-- Löschen-Button mit Mülltonne-Symbol -->
                    <form method="POST" action="delete_entry.php" style="display:inline;">
                        <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                        <button type="submit" name="delete_entry" class="button-common delete-btn">
                            <i class="button-icon fas fa-trash"></i> 
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Button zum Hinzufügen eines neuen Tagebucheintrags -->
    <div class="add-entry-btn-container">
        <a href="add_entry.php">
            <button class="button-common add-entry-btn">
                <i class="button-icon fas fa-plus"></i> Neuer Eintrag
            </button>
        </a>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

</body>

</html>