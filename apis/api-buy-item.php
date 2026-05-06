<?php
require_once __DIR__."/../db.php";

$pk = $_POST["key"] ?? "";

if(!$pk){
    http_response_code(400);
    echo "Mangler bolig id";
    exit;
}

$sql  = "UPDATE items SET is_sold = 1 WHERE pk = :pk";
$stmt = $_db->prepare($sql);
$stmt->bindValue(":pk", $pk);
$stmt->execute();
?>

<browser mix-update="#buy-section">
    <span class="status-sold">Solgt</span>
</browser>