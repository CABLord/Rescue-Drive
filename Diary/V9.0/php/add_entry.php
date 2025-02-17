<?php
require 'functions.php';
checkLogin();

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_entry'])) {
    $title = $_POST['title']; // Titel aus dem Formular holen
    $description = $_POST['description'];
    $coworker = isset($_POST['coworker']) ? $_POST['coworker'] : null;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Hole user_id aus der Session
    } else {
        die("Benutzer nicht eingeloggt."); // Sicherheitsmaßnahme
    }

    $pdo->beginTransaction();
    try {
        // Tagebucheintrag hinzufügen
        $sql1 = "INSERT INTO diary_entry (title, description, coworker, entry_timestamp) VALUES (:title, :description, :coworker, NOW())";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':title', $title, PDO::PARAM_STR); // Parameter für Titel binden
        $stmt1->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt1->bindParam(':coworker', $coworker, PDO::PARAM_STR);
        $stmt1->execute();

        $entry_id = $pdo->lastInsertId();

        // Eintrag des Benutzers zur 'user_diary' Tabelle hinzufügen
        $sql2 = "INSERT INTO user_diary (user_id, entry_id) VALUES (:user_id, :entry_id)";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt2->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt2->execute();

        $pdo->commit();
        header("Location: entries.php"); // Zurück zur Index-Seite nach erfolgreichem Eintrag
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Fehler beim Hinzufügen des Eintrags: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Neuer Tagebucheintrag</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/add_entry.css">
    <!-- Font Awesome CDN für die Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/entries.css"> <!-- Eigene CSS-Datei -->
    <script src="jscript/script.js" defer></script>
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

    <h2>Neuen Tagebucheintrag hinzufügen</h2>

    <!-- Erfolgs- oder Fehlermeldungen -->
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Formular zum Hinzufügen eines neuen Tagebucheintrags -->
    <form method="POST" action="add_entry.php">
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Beschreibung:</label><br>
        <textarea id="description" name="description" rows="10" cols="50" required></textarea>
        <label for="coworker">Betroffenen:</label><br>
        <input type="text" id="coworker" name="coworker" autocomplete="off"><br>
        <button type="submit" name="add_entry">Eintrag hinzufügen</button>
    </form>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>
</body>

</html>