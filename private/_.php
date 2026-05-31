<?php
// --------------------
// VALIDATION HELPERS
// --------------------


// XSS-safe: Sikker output-funktion
// Konverterer HTML-tegn til tekst, så bruger ikke kan injicere script
function _($text) {
    echo htmlspecialchars($text);
}


// --------------------
// EMAIL VALIDATION
// --------------------

// define used to make constants - værdier der aldrig ændrer sig
define("user_email_min", 6);
define("user_email_max", 50);

// Validate email from post
function _validate_user_email(){
    // Henter email fra POST-request (eller tom streng hvis den mangler)
    $user_email = $_POST["user_email"] ?? ""; 

    // fjern mellemrum i starten/slutningen
    $user_email = trim($user_email); 

    // Tjek minimums- og maksumumslængde OG om email har gyldigt format
    if(strlen($user_email) < user_email_min){
        throw new Exception("Email must be at least ".user_email_min." characters long", 400);
    }
        if(strlen($user_email) > user_email_max){
        throw new Exception("Email must be max ".user_email_max." characters long", 400);
    }
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        throw new Exception("Invalid email", 400);
    }
    return $user_email;
}


// --------------------
// USERNAME VALIDATION
// --------------------
define("user_username_min", 2);
define("user_username_max", 20);

// Validate username from POST-data
function _validate_user_username(){
    $user_username = $_POST["user_username"] ?? ""; // henter username fra POST-request
    $user_username = trim($user_username); // remove whitespace

    // Tjekker min og max længde
    if (strlen($user_username) < user_username_min) {
        throw new Exception("Username min ".user_username_min." characters", 400);
    }
    if (strlen($user_username) > user_username_max) {
        throw new Exception("Username max ".user_username_max." characters", 400);
    }
    return $user_username;
}


// --------------------
// PASSWORD VALIDATION
// --------------------
define("user_password_min", 6);
define("user_password_max", 50);
function _validate_user_password(){
    $user_password = $_POST["user_password"] ?? "";
    $user_password = trim($user_password); // remove whitespace
    if (strlen($user_password) < user_password_min) {
        throw new Exception("Userpassword min ".user_password_min." characters", 400);
    }
    if (strlen($user_password) > user_password_max) {
        throw new Exception("Userpassword max ".user_password_max." characters", 400);
    }
    return $user_password;
}


// --------------------
// CACHE CONTROL
// --------------------
// Forhindrer browseren i at cache sider og session-data (bruges især ved login/logout for at undgå "back button" issues)
function _no_cache(){
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"'); // ekstra resning af browser state (nyere browsersupport)
}