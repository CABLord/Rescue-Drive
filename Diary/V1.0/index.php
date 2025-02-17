<?php
// Verbindung zur Datenbank herstellen
$dsn = "mysql:host=10.10.31.11;dbname=ResQ_Drive;port=3306;charset=utf8;";
$user = "admin";
$pass = "Drive123";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fehler bei der Verbindung: " . $e->getMessage());
}
?>

<!-- HTML Tagebuch Formular -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Tagebuch</title>
</head>
<body>
    <h2>Neuer Tagebucheintrag</h2>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label>Beschreibung:</label><br>
        <textarea name="description" required></textarea><br>
        <button type="submit" name="add_entry">Eintrag hinzufügen</button>
    </form>
</body>
</html>

<?php
// Tagebuchseite
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_entry'])) {
    $description = $_POST['description'];

    $pdo->beginTransaction();
    try {
        $sql1 = "INSERT INTO diary_entry (description) VALUES (:description)";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt1->execute();

        $entry_id = $pdo->lastInsertId();

        // Annahme: Der Benutzer-ID-Wert wird festgelegt, wenn kein Login erforderlich ist
        $user_id = 9; // Beispielwert für Benutzer-ID

        $sql2 = "INSERT INTO user_diary (user_id, entry_id) VALUES (:user_id, :entry_id)";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt2->bindParam(':entry_id', $entry_id, PDO::PARAM_INT);
        $stmt2->execute();

        $pdo->commit();
        $success = "Eintrag erfolgreich hinzugefügt!";
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Fehler beim Hinzufügen des Eintrags: " . $e->getMessage();
    }
}
?>
