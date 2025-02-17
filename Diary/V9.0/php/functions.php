<?php
function formatDate($datetime) {
    $date = new DateTime($datetime);
    return $date->format('d.m.Y | H:i');
}

function checkLogin() {
    session_start();
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != 1) {
        $_SESSION['isLoggedIn'] = 0;
    }
}
?>