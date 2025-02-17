<?php
require 'functions.php';
checkLogin();

require 'db.php'; // Deine DB-Verbindung

// Prüfen, ob die entry_id in der URL übergeben wurde
if (isset($_GET['entry_id'])) {
    $entry_id = $_GET['entry_id'];

    // Den Eintrag aus der Datenbank abrufen
    $sql = "SELECT * FROM diary_entry WHERE entry_id = :entry_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['entry_id' => $entry_id]);
    $entry = $stmt->fetch(PDO::FETCH_ASSOC);

    // Wenn der Eintrag nicht gefunden wurde, wird eine Fehlermeldung angezeigt
    if (!$entry) {
        die("Eintrag nicht gefunden.");
    }
} else {
    die("Ungültige Anfrage.");
}

// Wenn das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $coworker = $_POST['coworker'];

    // SQL zum Aktualisieren des Eintrags
    $sql = "UPDATE diary_entry SET title = :title, description = :description, coworker = :coworker WHERE entry_id = :entry_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'coworker' => $coworker,
        'entry_id' => $entry_id
    ]);

    // Erfolgsmeldung anzeigen
    $success = "Eintrag erfolgreich bearbeitet!";

    header("Location: entries.php"); // Zurück zur Index-Seite nach erfolgreichem Eintrag
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Tagebuch Eintrag Bearbeiten</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/edit_entry.css"> <!-- Neue CSS-Datei -->
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/entries.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>Eintrag bearbeiten</h2>

    <!-- Bearbeitungsformular -->
    <form method="POST" action="edit_entry.php?entry_id=<?= htmlspecialchars($entry['entry_id']); ?>">
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($entry['title']); ?>" required><br>

        <label for="description">Beschreibung:</label><br>
        <textarea name="description" id="description" rows="10" cols="50" required><?= htmlspecialchars($entry['description']); ?></textarea><br>

        <label for="coworker">Betroffenen:</label><br>
        <input type="text" id="coworker" name="coworker" value="<?= htmlspecialchars($entry['coworker']); ?>" required><br>

        <button type="submit">Änderungen speichern</button>
    </form>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>
</body>

</html>