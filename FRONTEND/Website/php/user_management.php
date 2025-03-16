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

    // Überprüfen, ob der Benutzername bereits existiert
    $sql_check = "SELECT COUNT(*) FROM user_data WHERE username = :username";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':username', $username);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        // Benutzername existiert bereits
        $error = "Der Benutzername ist bereits vergeben. Bitte wähle einen anderen.";
    } else {
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
}

// Alle Benutzer abrufen (dies wird jetzt auch nach jeder Änderung oder Löschung erneut ausgeführt)
$sql_users = "SELECT username FROM user_data";
$stmt_users = $pdo->query($sql_users);
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Benutzer löschen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $username_to_delete = $_POST['username_to_delete'];

    // Überprüfen, ob der Benutzername existiert
    $sql_check_delete = "SELECT COUNT(*) FROM user_data WHERE username = :username";
    $stmt_check_delete = $pdo->prepare($sql_check_delete);
    $stmt_check_delete->bindParam(':username', $username_to_delete);
    $stmt_check_delete->execute();
    $count_delete = $stmt_check_delete->fetchColumn();

    if ($count_delete > 0) {
        // SQL-Befehl zum Löschen des Benutzers
        $sql_delete = "DELETE FROM user_data WHERE username = :username";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':username', $username_to_delete);

        if ($stmt_delete->execute()) {
            $success_delete = "Benutzer erfolgreich gelöscht!";
        } else {
            $error_delete = "Fehler beim Löschen des Benutzers.";
        }
    } else {
        $error_delete = "Benutzername nicht gefunden.";
    }

    // Benutzerliste nach dem Löschen neu laden
    $sql_users = "SELECT username FROM user_data";
    $stmt_users = $pdo->query($sql_users);
    $users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);
}

// Benutzer bearbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_user'])) {
    $username_to_edit = $_POST['username_to_edit'];

    // Neue Werte aus dem Formular (optional)
    $new_first_name = !empty($_POST['new_first_name']) ? $_POST['new_first_name'] : null;
    $new_last_name = !empty($_POST['new_last_name']) ? $_POST['new_last_name'] : null;
    $new_department = !empty($_POST['new_department']) ? $_POST['new_department'] : null;
    $new_username = !empty($_POST['new_username']) ? $_POST['new_username'] : null;
    $new_password = !empty($_POST['new_password']) ? hash('sha256', $_POST['new_password']) : null;

    // Überprüfen, ob der Benutzer existiert
    $sql_check_edit = "SELECT COUNT(*) FROM user_data WHERE username = :username";
    $stmt_check_edit = $pdo->prepare($sql_check_edit);
    $stmt_check_edit->bindParam(':username', $username_to_edit);
    $stmt_check_edit->execute();
    $count_edit = $stmt_check_edit->fetchColumn();

    if ($count_edit > 0) {
        // Dynamisches SQL für Updates
        $sql_edit = "UPDATE user_data SET";
        $params = [];

        if ($new_first_name) {
            $sql_edit .= " first_name = :first_name,";
            $params[':first_name'] = $new_first_name;
        }
        if ($new_last_name) {
            $sql_edit .= " last_name = :last_name,";
            $params[':last_name'] = $new_last_name;
        }
        if ($new_department) {
            $sql_edit .= " department = :department,";
            $params[':department'] = $new_department;
        }
        if ($new_username) {
            $sql_edit .= " username = :new_username,";
            $params[':new_username'] = $new_username;
        }
        if ($new_password) {
            $sql_edit .= " password = :new_password,";
            $params[':new_password'] = $new_password;
        }

        // Letztes Komma entfernen
        $sql_edit = rtrim($sql_edit, ',');
        $sql_edit .= " WHERE username = :username";
        $params[':username'] = $username_to_edit;

        // SQL ausführen
        $stmt_edit = $pdo->prepare($sql_edit);
        foreach ($params as $key => $value) {
            $stmt_edit->bindValue($key, $value);
        }

        if ($stmt_edit->execute()) {
            $success_edit = "Benutzer erfolgreich bearbeitet!";
        } else {
            $error_edit = "Fehler beim Bearbeiten des Benutzers.";
        }
    } else {
        $error_edit = "Benutzername nicht gefunden.";
    }

    // Benutzerliste nach dem Bearbeiten neu laden
    $sql_users = "SELECT username FROM user_data";
    $stmt_users = $pdo->query($sql_users);
    $users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>ResQ Drive - Benutzerverwaltung</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/user_management.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Menü einbinden -->
    <?php include 'html/menu.html'; ?>

    <div class="w3-content w3-padding" style="max-width:600px; margin-top: 100px;">
        <div class="w3-card-4 w3-padding-16 w3-margin-top">
            <!-- Formular zum Hinzufügen eines neuen Benutzers -->
            <h2 class="w3-center" style="color: #1976d2;"> Benutzer hinzufügen <i class="fas fa-user-plus" style="font-size: 22px;"></i> </h2>
            <!-- Erfolgs- oder Fehlermeldung anzeigen -->
            <?php if (isset($success)): ?>
                <p class="w3-text-green"><?= htmlspecialchars($success); ?>
                </p> <?php elseif (isset($error)): ?> <p class="w3-text-red">
                    <?= htmlspecialchars($error); ?></p> <?php endif; ?>
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

                    <input type="text" id="department" name="department" class="w3-input w3-border w3-round input-full" autocomplete="off" placeholder="Abteilung" required>

                    <input type="submit" name="add_user" value="Benutzer hinzufügen" class="w3-button w3-round input-full" style="background-color:#1976d2">
                </div>
            </form>

            <!-- Benutzer löschen -->
            <h2 class="w3-center" style="color: #1976d2;">Benutzer löschen <i class="fas fa-user-times"></i></h2>
            <?php if (isset($success_delete)): ?>
                <p class="w3-text-green"><?= htmlspecialchars($success_delete); ?></p>
            <?php elseif (isset($error_delete)): ?>
                <p class="w3-text-red"><?= htmlspecialchars($error_delete); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <select name="username_to_delete" class="w3-input w3-border w3-round" required>
                    <option value="" disabled selected>Benutzer auswählen</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= htmlspecialchars($user['username']); ?>"><?= htmlspecialchars($user['username']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="delete_user" value="Benutzer löschen" class="w3-button w3-round" style="background-color:#1976d2; color:white;">
            </form>

            <!-- Benutzer bearbeiten -->
            <h2 class="w3-center" style="color: #1976d2;">Benutzer bearbeiten <i class="fas fa-user-edit"></i></h2>
            <?php if (isset($success_edit)): ?>
                <p class="w3-text-green"><?= htmlspecialchars($success_edit); ?></p>
            <?php elseif (isset($error_edit)): ?>
                <p class="w3-text-red"><?= htmlspecialchars($error_edit); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <select name="username_to_edit" class="w3-input w3-border w3-round" required>
                    <option value="" disabled selected>Benutzer auswählen</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= htmlspecialchars($user['username']); ?>"><?= htmlspecialchars($user['username']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="new_first_name" class="w3-input w3-border w3-round" autocomplete="off" placeholder="Neuer Vorname" required>
                <input type="text" name="new_last_name" class="w3-input w3-border w3-round" autocomplete="off" placeholder="Neuer Nachname" required>
                <input type="text" name="new_username" class="w3-input w3-border w3-round" autocomplete="off" placeholder="Neuer Benutzername" required>

                <!-- Passwortfeld Container -->
                <div class="password-container">
                    <input type="password" name="new_password" class="w3-input w3-border w3-round" placeholder="Neues Passwort" required>
                    <i class="fas fa-eye" id="togglePassword" style="color: #1976d2;"></i>
                </div>

                <input type="text" name="new_department" class="w3-input w3-border w3-round" autocomplete="off" placeholder="Neue Abteilung" required>
                <input type="submit" name="edit_user" value="Benutzer bearbeiten" class="w3-button w3-round" style="background-color:#1976d2; color:white;">
            </form>

            <h2 class="w3-center" style="color: #1976d2;">Benutzerliste <i class="fas fa-users"></i></h2>
            <div class="w3-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th>Benutzername</th>
                            <th>Abteilung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_users = "SELECT first_name, last_name, username, department FROM user_data";
                        $stmt_users = $pdo->query($sql_users);
                        $users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($users as $user): ?>
                            <tr>
                                <td data-label="Vorname"><?= htmlspecialchars($user['first_name']); ?></td>
                                <td data-label="Nachname"><?= htmlspecialchars($user['last_name']); ?></td>
                                <td data-label="Benutzername"><?= htmlspecialchars($user['username']); ?></td>
                                <td data-label="Abteilung"><?= htmlspecialchars($user['department']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer einbinden -->
    <?php include 'html/footer.html'; ?>

    <script src="jscript/login.js"></script>
</body>

</html>