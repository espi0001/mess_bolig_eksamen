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

    // Send succesbesked
    echo "<div mix-update='#signup-response'>Bruger oprettet</div>";
    exit;
} catch(Exception $e) {
    // tjek om email findes i DB
    if(str_contains($e->getMessage(), "Duplicate entry") && str_contains($e->getMessage(), "user_email")){
        http_response_code(409); // 409 = conflict
        echo "<div mix-update='#signup-response'>Email er allerede i brug</div>";
        exit;
    }

    // Tjek om brugernan findes i DB
    if(str_contains($e->getMessage(), "Duplicate entry") && str_contains($e->getMessage(), "user_username")){
        http_response_code(409);
        echo "<div mix-update='#signup-response'>brugernavn er allerede i brug</div>";
        exit;
    }

    // Alle andre fejl - sender fejlkode og besked tilbage til browseren
    http_response_code($e->getCode());
    _($e->getMessage());
    exit;
}