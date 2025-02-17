<?php
require 'db.php';

if (isset($_GET['entry_id'])) {
    $entry_id = intval($_GET['entry_id']);

    // Beschreibung abrufen
    $sql = "SELECT description FROM diary_entry WHERE entry_id = :entry_id";
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Beschreibung</h2>
    <p><?= htmlspecialchars($entry['description']); ?></p>
    <a href="entries.php">Zurück</a>
</body>
</html>