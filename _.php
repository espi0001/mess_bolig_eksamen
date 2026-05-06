<?php
// VALIDATION //

// XSS-safe
function _($text) {
    echo htmlspecialchars($text);
}

// Email vailidation
// define bruges at lave konstanter - værdier der aldrig ændrer sig
define("user_email_min", 6);
define("user_email_max", 50);
function _validate_user_email(){
// Hent værdien fra POST — hvis den ikke findes, brug tom streng
    $user_email = $_POST["user_email"] ?? "";
    $user_email = trim($user_email);
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

// Username validation
define("user_username_min", 2);
define("user_username_max", 20);
function _validate_user_username(){
    $user_username = $_POST["user_username"] ?? "";
    $user_username = trim($user_username);
    if (strlen($user_username) < user_username_min) {
        throw new Exception("Username min ".user_username_min." characters", 400);
    }
    if (strlen($user_username) > user_username_max) {
        throw new Exception("Username max ".user_username_max." characters", 400);
    }
    return $user_username;
}

// Password validation
define("user_password_min", 6);
define("user_password_max", 50);
function _validate_user_password(){
    $user_password = $_POST["user_password"] ?? "";
    $user_password = trim($user_password);
    if (strlen($user_password) < user_password_min) {
        throw new Exception("Userpassword min ".user_password_min." characters", 400);
    }
    if (strlen($user_password) > user_password_max) {
        throw new Exception("Userpassword max ".user_password_max." characters", 400);
    }
    return $user_password;
}