<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_entry'])) {
    $description = $_POST['description'];
    $coworker = isset($_POST['coworker']) ? $_POST['coworker'] : null;
    $user_id = 1; // Beispielwert für Benutzer-ID

    $pdo->beginTransaction();
    try {
        $sql1 = "INSERT INTO diary_entry (description, coworker, entry_timestamp) VALUES (:description, :coworker, NOW())";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt1->bindParam(':coworker', $coworker, PDO::PARAM_STR);
        $stmt1->execute();

        $entry_id = $pdo->lastInsertId();

        $sql2 = "INSERT INTO user_diary (user_id, entry_id) VALUES (:user_id, :entry_id)";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt2->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt2->execute();

        $pdo->commit();
        header("Location: index.php"); // Seite neu laden
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Fehler beim Hinzufügen des Eintrags: " . $e->getMessage();
    }
}
?>