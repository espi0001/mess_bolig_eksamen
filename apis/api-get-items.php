<?php
// Opret forbindelse til DB
require_once __DIR__ . "/../private/db.php";

try {
    $sql = "SELECT * FROM items";

    // prepare SQL query til DB
    $stmt = $_db->prepare($sql);
    
    // Udfører query
    $stmt->execute();

    // Gemmer alle fundne rækker i et array
    $items = $stmt->fetchAll();
    
    // Returnerer data som JSON til JS
    echo json_encode($items);

} catch(Exception $e) {
    http_response_code(500);
    echo "database error";
}