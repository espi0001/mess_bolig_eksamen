<?php
try {
    // Hent hjælpefunktioner og konstanter (_, _validate, user_email_min osv.)
    require_once __DIR__ . "/../_.php";

    // Hent email og password fra POST-request
    $user_email = $_POST["user_email"] ?? "";
    $user_password = $_POST["user_password"] ?? "";

    // Tjek at email og password ikke er tomme
    if(strlen($user_email) < user_email_min){
        throw new Exception("Email mangler", 400);
    }
    if(strlen($user_password) < user_password_min){
        throw new Exception("Password mangler", 400);
    }

    // Opret forbindelse til databasen
    require_once __DIR__."/../db.php";

    // Søg efter bruger i databasen baseret på email
    $sql = "SELECT * FROM users WHERE user_email = :email";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":email", $user_email);
    $stmt->execute();

    // Hent den fundne bruger som et associativt array
    $user = $stmt->fetch();

    // Hvis ingen bruger findes med den email, afvis login
    // Vi siger "forkert email eller password" af sikkerhedshensyn
    // så en angriber ikke kan finde ud af hvilke emails der er registreret
    if(!$user){
        http_response_code(401); // 401 = Unauthorized
        echo '<div mix-update="#login-response">Forkert email eller password</div>';
        exit;
    }

    // Sammenlign det indtastede password med den gemte bcrypt-hash i databasen
    if(!password_verify($user_password, $user["user_password"])){
        http_response_code(401);
        echo '<div mix-update="#login-response">Forkert email eller password</div>';
        exit;
    }

    // Start session og gem brugerens data
    session_start();
    $_SESSION["user_pk"]       = $user["user_pk"];
    $_SESSION["user_username"] = $user["user_username"];
    $_SESSION["user_email"]    = $user["user_email"];

    // Redirect til forsiden via MixHTML efter succesfuldt login
    echo '<span mix-redirect="/"></span>';
    exit;

} catch(Exception $e) {
    // Send fejlkode tilbage og vis fejlbesked i login-response div
    http_response_code($e->getCode());
    echo '<div mix-update="#login-response">' . htmlspecialchars($e->getMessage()) . '</div>';
    exit;
}