<?php
session_start(); 
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_entry'])) {
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
        $sql1 = "INSERT INTO diary_entry (description, coworker, entry_timestamp) VALUES (:description, :coworker, NOW())";
        $stmt1 = $pdo->prepare($sql1);
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
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN für die Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script>
</head>

<body>
    <h2>Neuen Tagebucheintrag hinzufügen </h2>

    <!-- Erfolgs- oder Fehlermeldungen -->
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Formular zum Hinzufügen eines neuen Tagebucheintrags -->
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

    <!-- Footer einbinden --> 
    <?php include 'footer.html'; ?>

</body>

</html>