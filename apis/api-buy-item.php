<?php
// start session for at tjekke om brugeren er logget ind
session_start();

// tjek om bruger er logget ind (har en user_pk i sessionen)
if(empty($_SESSION["user_pk"])){
    http_response_code(401); // return if not logged in
    echo "<browser mix-update='#buy-section'>Du skal være logget ind for at købe en bolig</browser>";
    exit;
}

// DB forbindelsen
require_once __DIR__."/../private/db.php";

// Henter bolig pk fra POST-data
$pk = $_POST["key"] ?? "";

// Validering: stop hvis der ikke er sendt et bolig pk
if(!$pk){
    http_response_code(400);
    echo "Mangler bolig id";
    exit;
}

try {
    $sql  = "UPDATE items SET is_sold = 1 WHERE pk = :pk"; // marker boligen som solgt i db
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":pk", $pk); // binder bolig-pk sikkert til sql query -> (bindValue() beskytter mod SQL injection)
    $stmt->execute(); // udfører opdatering

} catch(Exception $e) {
    http_response_code(500); // hvis db fejler
    echo "database error";
    exit;
}
?>

<!-- Opdaterer købssektion efter køb -->
<browser mix-update="#buy-section">
    <span class="status-sold">Solgt</span>
</browser>