<?php
session_start();

// Datenbankverbindungsdetails
$dsn = "mysql:host=10.10.31.11;dbname=ResQ_Drive;port=3306;charset=utf8;";
$db_username = "admin";
$db_password = "Drive123";

// Verbindung zur Datenbank herstellen
try {
    $conn = new PDO($dsn, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

// Login-Logik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // SHA-256 Hashing

    $sql = "SELECT * FROM user_data WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Login erfolgreich
        $_SESSION['username'] = $username;
        echo "Login erfolgreich! Willkommen, " . htmlspecialchars($username);
    } else {
        // Login fehlgeschlagen
        echo "Ungültiger Benutzername oder ungültiges Passwort";
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