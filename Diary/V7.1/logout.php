<?php
session_start();

// Alle Session-Variablen löschen
$_SESSION = array();

// Wenn die Session-Cookies verwendet werden, löschen wir sie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Die Session zerstören
session_destroy();

// Weiterleitung zur Startseite
header("Location: mainpage1.php");
exit;
?>
