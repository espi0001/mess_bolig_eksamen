<?php
// Gør det muligt at læse og slette user session-data
session_start(); 

require_once __DIR__ . "/../private/_.php";

// forhindrer browser i at cache siden
_no_cache(); 

// Tømmer alle session-data (fjerner data lokalt i PHP)
$_SESSION = [];

// fjerner login-spor i browseren -> Hvis session bruger cookies, slettes session-cokkien også
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params(); // henter cookie-settings fra session
    
    // Sletter session-cookie ved at sætte udløbstid i fortiden
    setcookie(
        session_name(), // navnet på session-cookie
        '',
        time() - 42000, // udlæbet tid (i fortiden)
        $params['path'], // samme path som original cookie
        $params['domain'], // samme domæne
        $params['secure'], // kun HTTPS hvis der var sat før
        $params['httponly'] // beskytter mod JS adgang
    );
}

// fjerner session på serveren
session_destroy();

// Server redirect (http-redirect, som php sender direkte til browseren)
header('Location: /');
exit;
