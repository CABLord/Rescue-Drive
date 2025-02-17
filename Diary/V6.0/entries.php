<?php
require 'fetch_entries.php';
require 'functions.php';
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
            <th>Aktionen</th>
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

    <!-- Button zum Hinzufügen eines neuen Tagebucheintrags -->
    <div class="add-entry-btn-container">
        <a href="add_entry.php">
            <button class="add-entry-btn">
                <i class="fas fa-plus"></i> Neuer Eintrag
            </button>
        </a>
    </div>

</body>

</html>