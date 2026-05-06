<?php

require_once __DIR__ . "/../db.php";

$sql = "SELECT * FROM items";
$stmt = $_db->prepare($sql);

$stmt->execute();
$items = $stmt->fetchAll();

echo json_encode($items);