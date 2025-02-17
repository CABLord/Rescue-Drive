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

    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="index.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
            <div class="w3-right w3-hide-small">
                <a href="aboutus.php" class="w3-bar-item w3-button">Über uns</a>
                <a href="carinfo.php" class="w3-bar-item w3-button">Unser Produkt</a>
                <?php if($_SESSION["isLoggedIn"] == 1) : ?>
                    <a href="entries.php" class="w3-bar-item w3-button">Tagebuch</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="w3-bar-item w3-button">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <h2>Eintrag bearbeiten</h2>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <!-- Bearbeitungsformular -->
    <form method="POST" action="edit_entry.php?entry_id=<?= htmlspecialchars($entry['entry_id']); ?>">
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($entry['title']); ?>" required><br>

        <label for="description">Beschreibung:</label><br>
        <textarea name="description" id="description" rows="10" cols="50" required><?= htmlspecialchars($entry['description']); ?></textarea><br>

        <label for="coworker">Coworker:</label><br>
        <input type="text" id="coworker" name="coworker" value="<?= htmlspecialchars($entry['coworker']); ?>" required><br>

        <button type="submit">Änderungen speichern</button>
    </form>

    <br>
    <a href="entries.php">Zurück zur Übersicht</a>

    <!-- Footer einbinden --> 
    <?php include 'html/footer.html'; ?>
</body>

</html>