<?php
try {
    require_once __DIR__ . "/../_.php";

    // Henter og validerer brugerens input fra POST-request
    $user_email = _validate_user_email();
    $user_username = _validate_user_username();
    $user_password = _validate_user_password();

    // Hash passwordet
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    
    // Generer et unikt ID til UUID
    $user_pk = bin2hex(random_bytes(25));

    // opret forbindelsen til databasen
    require_once __DIR__."/../db.php";

    // Forbered SQL med placeholders
    $sql = "INSERT INTO users (user_pk, user_email, user_username, user_password) 
            VALUES (:user_pk, :email, :username, :password)";
    $stmt = $_db->prepare($sql);

    // Indsæt værdierne i placeholders
    $stmt->bindValue(":user_pk", $user_pk);
    $stmt->bindValue(":email", $user_email);
    $stmt->bindValue(":username", $user_username);
    $stmt->bindValue(":password", $hashed_password);

    // Udfør SQL forespørgslen og gem bruger i browser
    $stmt->execute();

    // Send succesbesked med nedtælling og redirect
    echo "
    <browser mix-update='#signup-response'>
        <h1>Bruger oprettet</h1>
        <p>Omdirigerer til login 3 sekunder...</p>
    </browser>
    <browser mix-script=\"setTimeout(() => { window.location.href = '/login'; }, 3000)\"></browser>

    ";
    
    exit;
} catch(Exception $e) {
    // tjek om email findes i DB
    if(str_contains($e->getMessage(), "Duplicate entry") && str_contains($e->getMessage(), "user_email")){
        http_response_code(409); // 409 = conflict
        echo "<browser mix-update='#email-error'>Email er allerede i brug</browser>";
        exit;
    }

    // Tjek om brugernan findes i DB
    if(str_contains($e->getMessage(), "Duplicate entry") && str_contains($e->getMessage(), "user_username")){
        http_response_code(409);        
        echo "<browser mix-update='#username-error'>Brugernavn er allerede i brug</browser>";
        exit;
    }

    // Email for kort
    if(str_contains($e->getMessage(), "Email must be at least")){
        http_response_code(400);
        echo "<browser mix-update='#email-error'>Email skal være mindst 6 tegn</browser>";
        exit;
    }

    // Email for lang
    if(str_contains($e->getMessage(), "Email must be max")){
        http_response_code(400);
        echo "<browser mix-update='#email-error'>Email må max være 50 tegn</browser>";
        exit;
    }

    // Email ugyldig format
    if(str_contains($e->getMessage(), "Invalid email")){
        http_response_code(400);
        echo "<browser mix-update='#email-error'>Ugyldig email adresse</browser>";
        exit;
    }

    // Brugernavn for kort
    if(str_contains($e->getMessage(), "Username min")){
        http_response_code(400);
        echo "<browser mix-update='#username-error'>Brugernavn skal være mindst 2 tegn</browser>";
        exit;
    }

    // Brugernavn for langt
    if(str_contains($e->getMessage(), "Username max")){
        http_response_code(400);
        echo "<browser mix-update='#username-error'>Brugernavn må max være 20 tegn</browser>";
        exit;
    }

    // Kodeord for kort
    if(str_contains($e->getMessage(), "Userpassword min")){
        http_response_code(400);
        echo "<browser mix-update='#password-error'>Kodeord skal være mindst 6 tegn</browser>";
        exit;
    }

    // Kodeord for langt
    if(str_contains($e->getMessage(), "Userpassword max")){
        http_response_code(400);
        echo "<browser mix-update='#password-error'>Kodeord må max være 50 tegn</browser>";
        exit;
    }

    // Alle andre fejl - sender fejlkode og besked tilbage til browseren
    http_response_code($e->getCode());
    _($e->getMessage());
    exit;
}