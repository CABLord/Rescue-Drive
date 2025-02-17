<?php
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