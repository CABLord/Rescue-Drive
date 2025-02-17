<?php
require 'functions.php';
checkLogin();

require 'db.php';

if (isset($_GET['entry_id'])) {
    $entry_id = intval($_GET['entry_id']);

    // Beschreibung abrufen
    $sql = "SELECT description, title FROM diary_entry WHERE entry_id = :entry_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
    $stmt->execute();
    $entry = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entry) {
        die("Eintrag nicht gefunden.");
    }
} else {
    die("Keine Eintrags-ID angegeben.");
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Beschreibung</title>
    <link rel="stylesheet" href="styles/description.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/buttons.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!-- W3.CSS von W3Schools -->
</head>

<body>
    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <div class="description">
        <h2><?= htmlspecialchars($entry['title']); ?></h2>
        <p><?= nl2br(htmlspecialchars($entry['description'])); ?></p>
        <a href="entries.php">
            <button class="button-common add-entry-btn">
                <i class="button-icon fas fa-plus"></i> Zurück
            </button>
        </a>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

</body>

</html>