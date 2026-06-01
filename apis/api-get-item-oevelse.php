<?php
// Step 1: tjek URL parameter - gå til http://127.0.0.1/apis/api-get-item-oevelse.php?item_pk=test
/* 
$item_pk = $_GET["item_pk"] ?? "";
echo $item_pk;
exit
*/

// Step 2: tjek DB forbindelse -> du kan se okay på browseren på http://127.0.0.1/apis/api-get-item-oevelse.php
/* 
$item_pk = $_GET["item_pk"] ?? "";
require_once __DIR__ . "/../private/db.php";
echo "db ok";
exit;
*/

// Step 3: tjek SQL returnerer data fra DB 
/* 
$item_pk = $_GET["item_pk"] ?? "";
require_once __DIR__ . "/../private/db.php";
$sql = "SELECT * FROM items";
$stmt = $_db->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll();

echo json_encode($items);
exit;
*/

// Step 4: tjek SQL returnerer data fra DB på specifik item pk - http://127.0.0.1/apis/api-get-item-oevelse.php?item_pk=0000b92545a34494b12c6efd133c738e
/*
$item_pk = $_GET["item_pk"] ?? "";
require_once __DIR__ . "/../private/db.php";
$sql = "SELECT * FROM items WHERE pk = :item_pk";
$stmt = $_db->prepare($sql);
$stmt->bindValue(":item_pk", $item_pk);
$stmt->execute();
$item = $stmt->fetch();

echo json_encode($item);
exit;
*/
?>

