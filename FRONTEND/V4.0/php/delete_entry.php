<?php
require 'db.php'; // Verbindung zur Datenbank

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
    $entry_id = $_POST['entry_id'];
    
    try {
        $pdo->beginTransaction();
        // Referenz in der Zwischentabelle user_diary löschen
        $sql1 = "DELETE FROM user_diary WHERE entry_id = :entry_id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt1->execute();

        // Eintrag in diary_entry löschen
        $sql2 = "DELETE FROM diary_entry WHERE entry_id = :entry_id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt2->execute();

        $pdo->commit();

        // Zurück zur Hauptseite
        header("Location: entries.php");
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Fehler beim Löschen des Eintrags: " . $e->getMessage());
    }
}
