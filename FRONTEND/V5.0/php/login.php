<?php
require 'functions.php';
checkLogin();

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
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['location'] = "index.php";

        // Weiterleitung zur entries.php
        header("Location: " . $_SESSION['location']);
        exit;
    } else {
        $error = "Ungültige Anmeldedaten."; // Fehlernachricht
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
    <link rel="stylesheet" href="styles/login.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/global.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <!-- Login Container -->
    <div class="w3-content w3-padding" style="max-width:600px; margin-top: 100px;">
        <div class="w3-card-4 w3-padding-16 w3-margin-top">
            <h2 class="w3-center" style="color: #1976d2;">
                Login <i class="fas fa-lock" style="font-size: 22px; width: 20px; height: 20px;"></i>
            </h2>

            <!-- Fehlernachricht anzeigen -->
            <?php if (isset($error)): ?>
                <p class="w3-text-red"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <!-- Login Formular -->
            <form method="POST" action="">
                <div class="w3-container">
                    <input type="text" id="username" name="username" class="w3-input w3-border w3-round input-full" autocomplete="off" placeholder="Benutzername">

                    <!-- Passwortfeld mit Auge-Icon -->
                    <div class="password-container">
                        <input type="password" id="password" name="password" class="w3-input w3-border w3-round input-full" placeholder="Passwort">
                        <i class="fas fa-eye" id="togglePassword" style="color: #1976d2;"></i>
                    </div>
 
                    <input type="submit" value="Login" class="w3-button w3-round input-full" style="background-color:#1976d2">
                </div>
            </form>
        </div>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="jscript/login.js"></script>
</body>

</html>
