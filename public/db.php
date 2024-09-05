<?php
$bdserver = 'localhost';
$dbname = 'promisedb';
$user_name = 'root';
$pass = '';

try{
   
    $pdo = new PDO("mysql:host=localhost; dbname=promisedb; charset=utf8", $user_name, $pass) or die('connection failed!');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}
catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
}