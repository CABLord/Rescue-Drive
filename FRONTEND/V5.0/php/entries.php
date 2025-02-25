<?php
require 'fetch_entries.php';
require 'functions.php';

checkLogin();

$_SESSION['location'] = "index.php";
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
    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>Tagebucheinträge</h2>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Eingetragen von</th>
                    <th>Betroffene Mitarbeiter</th>
                    <th>Tagebucheintrag vom</th>
                    <th>Eingetragen am</th>
                    <th>Beschreibung</th>
                    <th>Bearbeiten</th>
                    <th>Löschen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td data-label="Eingetragen von"><?= htmlspecialchars($entry['uploader']); ?></td>
                        <td data-label="Betroffene Mitarbeiter"><?= htmlspecialchars($entry['coworker']); ?></td>
                        <td data-label="Tagebucheintrag vom"><?= htmlspecialchars($entry['title']); ?></td>
                        <td data-label="Eingetragen am"><?= htmlspecialchars(formatDate($entry['date'])); ?></td>
                        <td data-label="Beschreibung">
                            <a href="description.php?entry_id=<?= htmlspecialchars($entry['entry_id']); ?>" class="button-common description-btn">
                                <i class="button-icon fas fa-file-alt"></i>
                            </a>
                        </td>
                        <td data-label="Bearbeiten">
                            <form method="GET" action="edit_entry.php" style="display:inline;">
                                <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                                <button type="submit" name="edit_entry" class="button-common edit-btn">
                                    <i class="button-icon fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td data-label="Löschen">
                            <form method="POST" action="delete_entry.php" style="display:inline;">
                                <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']); ?>">
                                <button type="submit" name="delete_entry" class="button-common delete-btn">
                                    <i class="button-icon fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


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