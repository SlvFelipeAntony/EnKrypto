<?php

function newConnection($base = 'passmanager'){
    $server = 'localhost';
    $user = 'root';
    $password = '';

    $connection = new mysqli($server, $user, $password, $base);

    if($connection -> connect_error){
        die('Erro: ' . $connection -> connect_error);
    }
    return $connection;
}

$base = 'passmanager';
$connection = newConnection($base);
$sql = 'CREATE DATABASE IF NOT EXISTS $base';
$result = $connection -> query($sql);