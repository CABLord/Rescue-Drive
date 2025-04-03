<?php
// Fehleranzeige aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS-Header setzen
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// OPTIONS-Anfragen für CORS-Handhabung sofort beenden
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Sicherstellen, dass es sich um eine POST-Anfrage handelt
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit;
}

// JSON-Daten aus der Anfrage lesen
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['command'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Command is required']);
    exit;
}

$command = $data['command'];
$raspberryPiUrl = 'http://192.168.88.96:4000/control'; // Ziel-API des Raspberry Pi
$postData = json_encode(['command' => $command]);

// cURL initialisieren
$ch = curl_init($raspberryPiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Debugging: cURL Fehlerausgabe aktivieren
curl_setopt($ch, CURLOPT_VERBOSE, true);

$response = curl_exec($ch);

// Überprüfen, ob cURL Fehler aufgetreten ist
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    http_response_code(500);
    echo json_encode(['error' => 'cURL Error: ' . $error]);
    exit;
}

// Debugging: cURL Antwort loggen
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header('Content-Type: application/json');
if ($httpCode !== 200) {
    http_response_code(500);
    echo json_encode(['error' => 'Invalid response from Raspberry Pi', 'status_code' => $httpCode, 'response' => $response]);
} else {
    echo json_encode(['message' => 'Command forwarded successfully', 'response' => json_decode($response)]);
}
?>

