<?php
require 'functions.php';
checkLogin();

// Einbinden der Datei db.php für die Datenbankverbindung
require_once 'db.php';

// Benutzer hinzufügen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // Passwort verschlüsseln
    $department = $_POST['department']; // Abteilung des Benutzers

    // SQL-Befehl zum Hinzufügen des Benutzers
    $sql = "INSERT INTO user_data (first_name, last_name, username, password, department) 
            VALUES (:first_name, :last_name, :username, :password, :department)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':department', $department);

    if ($stmt->execute()) {
        $success = "Benutzer erfolgreich hinzugefügt!";
    } else {
        $error = "Fehler beim Hinzufügen des Benutzers.";
    }
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>ResQ Drive - Benutzerverwaltung</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/user_management.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/global.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="styles/footer.css"> <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <!-- Benutzerverwaltung Container -->
    <div class="w3-content w3-padding" style="max-width:600px; margin-top: 100px;">
        <div class="w3-card-4 w3-padding-16 w3-margin-top">
            <h2 class="w3-center" style="color: #1976d2;">
                Benutzer hinzufügen <i class="fas fa-user-plus" style="font-size: 22px;"></i>
            </h2>

            <!-- Erfolgs- oder Fehlermeldung anzeigen -->
            <?php if (isset($success)): ?>
                <p class="w3-text-green"><?= htmlspecialchars($success); ?></p>
            <?php elseif (isset($error)): ?>
                <p class="w3-text-red"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <!-- Formular zum Hinzufügen eines neuen Benutzers -->
            <form method="POST" action="">
                <div class="w3-container">
                    <input type="text" id="first_name" name="first_name" class="w3-input w3-border w3-round input-full" autocomplete="off" placeholder="Vorname" required>

                    <input type="text" id="last_name" name="last_name" class="w3-input w3-border w3-round input-full" autocomplete="off" placeholder="Nachname" required>

                    <input type="text" id="username" name="username" class="w3-input w3-border w3-round input-full" autocomplete="off" placeholder="Benutzername" required>

                    <!-- Passwortfeld Container -->
                    <div class="password-container">
                        <input type="password" id="password" name="password" class="w3-input w3-border w3-round input-full" placeholder="Passwort" required>
                        <i class="fas fa-eye" id="togglePassword" style="color: #1976d2;"></i>
                    </div>

                    <input type="text" id="department" name="department" class="w3-input w3-border w3-round input-full" placeholder="Abteilung" required>

                    <input type="submit" name="add_user" value="Benutzer hinzufügen" class="w3-button w3-round input-full" style="background-color:#1976d2">
                </div>
            </form>

        </div>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="jscript/login.js"></script>
</body>

</html>