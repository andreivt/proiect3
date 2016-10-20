<?php

$server = 'localhost';
$user = 'root';
$pwd = 'root';
$dbname = 'proiect3';
$connection_status = array();
try {
    $connection = new PDO("mysql:host=$server;dbname=$dbname", $user, $pwd);
    // PDO can throw exceptions rather than Fatal errors, so let's change the error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection_status['status'] = 1;
    $connection_status['message'] = 'Conectat cu succes la DB';
} catch (PDOException $e) {
    $connection_status['status'] = 0;
    $connection_status['message'] = 'Eroare la conectare: '.$e->getMessage();
}
