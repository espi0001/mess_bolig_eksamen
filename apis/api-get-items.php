<?php

require_once __DIR__ . "/../private/db.php";

try {
    $sql = "SELECT * FROM items";
    $stmt = $_db->prepare($sql);
    
    $stmt->execute();
    $items = $stmt->fetchAll();
    
    echo json_encode($items);
} catch(Exception $e) {
    http_response_code(500);
    echo "database error";
}