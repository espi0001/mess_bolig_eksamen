<?php
// --------------------
// DATABASE CONNECTION (PDO)
// --------------------

try{
  $dbUserName = 'root';
  $dbPassword = 'password'; // root | admin

  // Connection string til DB
  $dbConnection = 'mysql:host=mariadb; dbname=mess_bolig_eksamen; charset=utf8mb4'; 
  // utf8: every character in the world
  // mb4: every character and also emojies


  // PDO options styrer hvordan DB opfører sig
  $options = [
    // Gør at SQL fejl thows exceptions (kan fanges i try-catch)
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 

    // Returnerer data som associative arrays: ["column" => value]
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // ['nickname']

    // Alternativer (ikke aktive)
    //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ // giver objekter ($row->column) ->nickname
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM // Giver numerisk arrays ([0],[1],[2])
  ];

  // Opretter PDO database connection
  $_db = new PDO(  $dbConnection, 
                  $dbUserName, 
                  $dbPassword , 
                  $options );
  
}catch(PDOException $ex){
  // Hvis db connection fejler: viser fejl og stopper programet
  echo $ex;  
  exit(); // die -> stopper scriptet helt
}