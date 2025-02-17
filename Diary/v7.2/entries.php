<?php
require 'fetch_entries.php';
require 'functions.php';
session_start();
if($_SESSION['isLoggedIn'] != 1) :
    $_SESSION['isLoggedIn'] = 0;
endif;
$_SESSION['location'] = "mainpage.php";
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Tagebuch</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN für die Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="script.js" defer></script>
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

    <h2>Tagebucheinträge</h2>
    <table>
        <tr>
            <th>Eintrager</th>
            <th>Verfasser</th>
            <th>Beschreibung</th>
            <th>Datum</th>
            <th>Bearbeiten</th>
            <th>Aktionen</th>
        </tr>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= htmlspecialchars($entry['uploader']); ?></td>
                <td><?= htmlspecialchars($entry['coworker']); ?></td>
                <td>
                    <!-- Beschreibung-Button -->
                    <a href="description.php?entry_id=<?= htmlspecialchars($entry['entry_id']); ?>" class="description-btn">
                        <i class="fas fa-file-alt"></i> Beschreibung anzeigen
                    </a>
                </td>
                <td><?= htmlspecialchars(formatDate($entry['date'])); ?></td>
                <td>
                    <!-- Bearbeiten-Button mit Stiftsymbol -->
                    <form method="GET" action="edit_entry.php" style="display:inline;">
                        <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                        <button type="submit" name="edit_entry" class="edit-btn">
                            <i class="fas fa-edit"></i> Bearbeiten
                        </button>
                    </form>
                </td>
                <td>
                    <!-- Löschen-Button mit Mülltonne-Symbol -->
                    <form method="POST" action="delete_entry.php" style="display:inline;">
                        <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                        <button type="submit" name="delete_entry" class="delete-btn">
                            <i class="fas fa-trash"></i> Löschen
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Button zum Hinzufügen eines neuen Tagebucheintrags -->
    <div class="add-entry-btn-container">
        <a href="add_entry.php">
            <button class="add-entry-btn">
                <i class="fas fa-plus"></i> Neuer Eintrag
            </button>
        </a>
    </div>

    <!-- Footer einbinden --> 
    <?php include 'footer.html'; ?>
</body>

</html>
