<?php
session_start();
if(empty($_SESSION["user_pk"])){
    http_response_code(401);
    echo "<browser mix-update='#buy-section'>Du skal være logget ind for at købe en bolig</browser>";
    exit;
}

require_once __DIR__."/../private/db.php";

$pk = $_POST["key"] ?? "";

if(!$pk){
    http_response_code(400);
    echo "Mangler bolig id";
    exit;
}

try {
    $sql  = "UPDATE items SET is_sold = 1 WHERE pk = :pk";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":pk", $pk);
    $stmt->execute();
} catch(Exception $e) {
    http_response_code(500);
    echo "database error";
    exit;
}
?>

<browser mix-update="#buy-section">
    <span class="status-sold">Solgt</span>
</browser>