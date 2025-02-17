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

// Daten aus der Tabelle diary_entry abrufen
$sql = "SELECT u.first_name AS uploader, d.entry_timestamp AS date, d.description, d.coworker
        FROM diary_entry d 
        JOIN user_diary ud ON d.entry_id = ud.entry_id
        JOIN user_data u ON ud.user_id = u.user_id";
$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Datumsformat ändern 
function formatDate($datetime) {
    $date = new DateTime($datetime);
    return $date->format('d.m.Y');
}
?>

<!-- HTML Tagebuch Einträge und Formular -->
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Tagebuch</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1;}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <h2>Tagebucheinträge</h2>
    <table border="1">
        <tr>
            <th>Eintrager</th>
            <th>Verfasser</th>
            <th>Beschreibung</th>
            <th>Datum</th>
        </tr>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?php echo htmlspecialchars($entry['uploader']); ?></td>
                <td><?php echo htmlspecialchars($entry['coworker']); ?></td>
                <td><?php echo htmlspecialchars($entry['description']); ?></td>
                <td><?php echo htmlspecialchars(formatDate($entry['date'])); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Neuer Tagebucheintrag</h2>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
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

    <script>
        function auswahl(person) {
            document.getElementById("selected-person").textContent = "Ausgewählte Person: " + person;
            document.getElementById("hiddenCoworker").value = person;
        }
    </script>
</body>

</html>

<?php
// Tagebucheintrag hinzufügen
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
        $stmt2->bindParam(':user_id', $creator, PDO::PARAM_INT);
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