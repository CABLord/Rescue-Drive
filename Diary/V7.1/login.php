<?php
session_start();

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
        $_SESSION['logged_in'] = true; // Setze die logged_in Variable auf true
        
        // Weiterleitung zur entries.php
        header("Location: mainpage2.php");
        exit;
    } else {
        $_SESSION['logged_in'] = false; // Setze die logged_in Variable auf false
        $error = "Benutzername oder Passwort sind falsch."; // Fehlernachricht
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>ResQ Drive - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!-- W3.CSS von W3Schools -->
    <link rel="stylesheet" href="login.css"> <!-- Eigene CSS-Datei -->
</head>

<body class="w3-light-grey">

<!-- W3 Top Bar -->
<div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="mainpage.php" class="w3-bar-item w3-button"><b>ResQ</b> Drive</a>
    <div class="w3-right w3-hide-small">
        <a href="aboutus.php" class="w3-bar-item w3-button">Über uns</a>
        <a href="carinfo.php" class="w3-bar-item w3-button">Unser Produkt</a>
        <a href="login.php" class="w3-bar-item w3-button">Login</a>
    </div>
</div>

<!-- Login Container -->
<div class="w3-content w3-padding" style="max-width:600px; margin-top: 100px;">
    <div class="w3-card-4 w3-white w3-padding-16 w3-margin-top">
        <h2 class="w3-center">Login</h2>

        <!-- Fehlernachricht anzeigen -->
        <?php if (isset($error)): ?>
            <p class="w3-text-red"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Login Formular -->
        <form method="POST" action="">
            <div class="w3-row-padding">
                <div class="w3-third w3-margin-bottom">
                    <label for="username">Benutzername:</label>
                    <input type="text" id="username" name="username" class="w3-input w3-border w3-round" required>
                </div>
            </div>
            <div class="w3-row-padding">
                <div class="w3-third w3-margin-bottom">
                    <label for="password">Passwort:</label>
                    <input type="password" id="password" name="password" class="w3-input w3-border w3-round" required>
                </div>
            </div>
            <input type="submit" value="Login" class="w3-button w3-block w3-blue w3-round">
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
    <p>Powered by <a href="https://www.fallmerayer.it" title="W3.CSS" target="_blank" class="w3-hover-text-green">J. Ph. Fallermayer</a></p>
    <p>Dantestraße, 39E, 39042 Brixen</p>
    <p>+39 347 699 5656</p>
    <p>stleifab@bx.fallmerayer.it</p>
</footer>

</body>
</html>