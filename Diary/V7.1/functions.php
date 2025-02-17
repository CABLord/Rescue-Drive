<?php
function formatDate($datetime) {
    $date = new DateTime($datetime);
    return $date->format('d.m.Y H:i');
}

function checkLogin() {
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Benutzer ist nicht angemeldet, Weiterleitung zur Login-Seite
        header("Location: login.php");
        exit;
    }
}
?>
