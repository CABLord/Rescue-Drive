<?php
header("Content-Type: application/json");

// Datei zum Speichern der Daten
$dataFile = "data.json";

// Überprüfen, ob Daten per POST gesendet wurden
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    if ($data) {
        // Vorherige Daten laden
        $existingData = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

        // Neue Daten hinzufügen
        $existingData[] = $data;

        // In Datei speichern
        file_put_contents($dataFile, json_encode($existingData, JSON_PRETTY_PRINT));

        echo json_encode(["message" => "Data saved successfully"]);
    } else {
        echo json_encode(["error" => "Invalid JSON data"]);
    }
    exit;
}

// Falls ein GET-Request kommt, Daten zurückgeben
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (file_exists($dataFile)) {
        echo file_get_contents($dataFile);
    } else {
        echo json_encode([]);
    }
    exit;
}
?>