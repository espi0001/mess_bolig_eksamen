<?php
try {
    require_once __DIR__ . "/../_.php";

    // Hent email og password fra POST-request
    $user_email = $_POST["user_email"] ?? "";
    $user_password = $_POST["user_password"] ?? "";

    // Tjekker at email og password ikke er tomme
    if(strlen($user_email) < user_email_min){
        throw new Exception("Email mangler", 400);
    }
    if(strlen($user_password) < user_password_min){
        throw new Exception("Password mangler", 400);
    }

    // Opret forbindelse til DB
    require_once __DIR__."/../db.php";

    // Søger efter brugere i DB baseret på email
    $sql = "SELECT * FROM users WHERE user_email = :email";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":email", $user_email);
    $stmt->execute();

    // Hent den fundne bruger som et associativt array
    $user = $stmt->fetch();

    // Hvis ingen bruger finden med den mail, afvis login
    if(!$user){
        http_response_code(401); // 401 = Unauthorized
        _("Forkert email eller password");
        exit;
    }

    // Sammenligner password med hashed passwword i DB
    if(!password_verify($user_password, $user["user_password"])){
        http_response_code(401);
        _("Forkert email eller password");
        exit;
    }

    // Start session 
    session_start();
    $_SESSION["user_pk"] = $user["user_pk"];
    $_SESSION["user_username"] = $user["user_username"];
    $_SESSION["user_email"] = $user["user_email"];

    // Send succesbesked 
    _("Logget ind som ".$user["user_username"]);
    exit;

} catch(Exception $e) {
    // Send fejlkode og besked tilbage
    http_response_code($e->getCode());
    _($e->getMessage());
    exit;
}

// PHP replies with a 200 by default