<?php
require 'functions.php';
checkLogin();

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
    <link rel="stylesheet" href="styles/description.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!-- W3.CSS von W3Schools -->
</head>

<body>
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="index.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
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

    <div class="description">
        <h2>Beschreibung</h2>
        <p><?= nl2br(htmlspecialchars($entry['description'])); ?></p>
        <a href="entries.php">Zurück</a>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

</body>

</html>