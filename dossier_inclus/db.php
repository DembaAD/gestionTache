<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=test","root","",[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
}catch(PDOException $e){
    return $e->getMessage();
}