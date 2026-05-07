<?php
require_once __DIR__ . "/../db.php";

$q = trim($_GET["q"] ?? "");

if ($q === "") {
    $sql = "SELECT * FROM items";
    $stmt = $_db->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll());
    exit;
}

$sql = "SELECT * FROM items WHERE type LIKE :q";
$stmt = $_db->prepare($sql);
$stmt->bindValue(":q", "%" . $q . "%");
$stmt->execute();

echo json_encode($stmt->fetchAll());
