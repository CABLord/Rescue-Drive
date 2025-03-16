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

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <h2>Neuen Tagebucheintrag hinzufügen</h2>

    <!-- Erfolgs- oder Fehlermeldungen -->
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Formular zum Hinzufügen eines neuen Tagebucheintrags -->
    <form method="POST" action="add_entry.php">
        <label for="title">Tagebucheintrag vom:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Beschreibung:</label><br>
        <textarea id="description" name="description" rows="10" cols="50" required></textarea>
        <label for="coworker">Betroffene Mitarbeiter:</label><br>
        <input type="text" id="coworker" name="coworker" autocomplete="off"><br>
        <container>
            <button type="submit" name="add_entry">Eintrag hinzufügen</button>
        </container>
    </form>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>
</body>

</html>