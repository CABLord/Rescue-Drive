<?php
session_start();

// Einbinden der Datei db.php für die Datenbankverbindung
require_once 'db.php';

// Login-Logik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // SHA-256 Hashing

    $sql = "SELECT * FROM user_data WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql); 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Login erfolgreich
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $result['user_id']; // user_id aus der Datenbank in der Session speichern
        
        // Weiterleitung zur entries.php
        header("Location: entries.php");
        exit; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
