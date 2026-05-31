<?php
try {
    require_once __DIR__ . "/../private/_.php"; // til validering 

    // Hent email og password fra POST-request
    $user_email = _validate_user_email();
    $user_password = _validate_user_password();

    require_once __DIR__."/../private/db.php"; // opretter DB forbindelsen

    // Finder bruger i DB baseret på email
    $sql = "SELECT * FROM users WHERE user_email = :email";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":email", $user_email);
    $stmt->execute();
    $user = $stmt->fetch(); // Hent brugerdata som et associativt array 

    // Hvis ingen bruger findes med den email, afvis login
    // Sikkerhedsregel: samme fejlbesked uanset om email findes eller ej -> (så angriber ikke finder ud af hvilke emails der er registreret)
    if(!$user){
        http_response_code(401); // 401 = Unauthorized
        echo '<div mix-update="#login-response">Forkert email eller password</div>';
        exit;
    }

    // Tjekker password mod hashed version i db (bcrypt-hash i db)
    if(!password_verify($user_password, $user["user_password"])){
        http_response_code(401);
        echo '<div mix-update="#login-response">Forkert email eller password</div>';
        exit;
    }

    // Start session når login er godkendt
    session_start();

    // Gemmer brugerdata i session så bruger forbliver logget ind
    $_SESSION["user_pk"]       = $user["user_pk"];
    $_SESSION["user_username"] = $user["user_username"];
    $_SESSION["user_email"]    = $user["user_email"];

    // Redirect til forsiden efter succesfuldt login
    echo '<span mix-redirect="/"></span>';
    exit;

} catch(Exception $e) {
    // Returner fejlkode 
    http_response_code($e->getCode()); 
    
    // Viser fejlbeskrd i UI (sikret mod XSS)
    echo '<div mix-update="#login-response">' . htmlspecialchars($e->getMessage()) . '</div>'; // bruger concatination
    exit;
}