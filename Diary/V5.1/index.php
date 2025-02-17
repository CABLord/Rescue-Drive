<?php
require 'fetch_entries.php';
require 'functions.php';
require 'add_entry.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Tagebuch</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN für die Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script>
</head>

<body>
    <h2>Tagebucheinträge</h2>
    <table>
        <tr>
            <th>Eintrager</th>
            <th>Verfasser</th>
            <th>Beschreibung</th>
            <th>Datum</th>
            <th>Bearbeiten</th> 
            <th>Aktionen</th> <!-- Neue Spalte für den Bearbeiten-Button -->
        </tr>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= htmlspecialchars($entry['uploader']); ?></td>
                <td><?= htmlspecialchars($entry['coworker']); ?></td>
                <td><?= htmlspecialchars($entry['description']); ?></td>
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

    <h2>Neuer Tagebucheintrag</h2>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="add_entry.php">
        <label>Beschreibung:</label><br>
        <textarea name="description" required></textarea><br>
        <label>Coworker:</label><br>
        <div class="dropdown">
            <button class="dropbtn">Coworker auswählen</button>
            <div class="dropdown-content">
                <a href="#" onclick="auswahl('Alex')">Alex</a>
                <a href="#" onclick="auswahl('Fabian')">Fabian</a>
                <a href="#" onclick="auswahl('Felix')">Felix</a>
                <a href="#" onclick="auswahl('Florian')">Florian</a>
                <a href="#" onclick="auswahl('Ivan')">Ivan</a>
                <a href="#" onclick="auswahl('Lorik')">Lorik</a>
            </div>
        </div>
        <input type="hidden" name="coworker" id="hiddenCoworker">
        <p id="selected-person"></p>
        <button type="submit" name="add_entry">Eintrag hinzufügen</button>
    </form>
</body>

</html>