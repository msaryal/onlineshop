<?php
$driver = 'mysql';
$host = 'localhost';
$name = 'site';
$user = 'root';
$pass = '';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try{
    $pdo = new PDO("$driver:host=$host;dbname=$name;charset=$charset", $user, $pass, $options);
}
catch(PDOException $i){
    die("Ошибка подключения к базе данных!");
}
?>