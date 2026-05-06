<?php
try {
    // require_once __DIR__ . "/../_.php";

    // Super global post
    $user_email = $_POST["user_email"] ?? "";
    $user_password = $_POST["user_password"] ?? "";

    // min 2 max 20 - is less than 2, then echo username too short
    if(strlen($user_email) < 2){
        http_response_code(400); // Inform the browser / api that there is a mistake from the user
        echo "Email too short";
        exit; // Prevent it to run after this
    }
    if( strlen($user_email) > 20){
        http_response_code(400);
        echo "Email too long";
        exit;
    }

    if(strlen($user_password) < 2){
        http_response_code(400);
        echo "Password too short";
        exit; 
    }
    if(strlen($user_password) > 20){
        http_response_code(400);
        echo "Password too long";
        exit;
    }

    echo "success";
} catch(Exception $e) {
    http_response_code(500);
    echo "Server fejl: " . $e->getMessage();
    exit;
}

// PHP replies with a 200 by default